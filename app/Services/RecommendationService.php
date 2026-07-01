<?php

namespace App\Services;

use App\Models\EmploymentPrediction;
use App\Models\JobPost;
use App\Models\JobRecommendation;
use App\Models\PwdProfile;
use Exception;

class RecommendationService
{
    public function generateForProfile(PwdProfile $profile): array
    {
        $profile->load(['skills', 'registryReference']);

        $prediction = EmploymentPrediction::where('pwd_profile_id', $profile->id)->first();

        if (!$prediction) {
            throw new Exception('Generate employment prediction first.');
        }

        $availableJobs = JobPost::where('status', 'open')
            ->with('skills')
            ->get()
            ->map(function ($job) {
                return [
                    'id' => $job->id,
                    'job_title' => $job->job_title,
                    'job_description' => $job->job_description,
                    'required_skills' => $job->skills->pluck('skill_name')->implode(', '),
                    'employment_type' => $job->employment_type,
                    'required_education' => '',
                    'disability_friendly_notes' => '',
                    'compatible_disabilities' => [],
                ];
            })
            ->toArray();

        $registry = $profile->registryReference;

        $payload = [
            'applicant_data' => [
                'disability_type' => $registry->disability_type ?? '',
                'mobility_status' => $registry->mobility_status ?? '',
                'current_assistive_device' => $registry->current_assistive_device ?? 'None',
                'skills' => $profile->skills->pluck('skill_name')->implode(', '),
                'preferred_employment_type' => $prediction->predicted_employment_type,
                'preferred_job_category' => '',
                'educational_attainment' => $registry->educational_attainment ?? $profile->education ?? '',
                'occupation_group' => $registry->occupation_group ?? '',
            ],
            'available_jobs' => $availableJobs,
            'predicted_employment_type' => $prediction->predicted_employment_type,
            'top_n' => 5,
        ];

        $result = $this->runPythonScript($payload);

        JobRecommendation::where('pwd_profile_id', $profile->id)->delete();

        foreach ($result['recommendations'] ?? [] as $rec) {
            JobRecommendation::create([
                'pwd_profile_id' => $profile->id,
                'job_post_id' => $rec['job_id'],
                'similarity_score' => $rec['similarity_score'],
                'recommendation_rank' => $rec['rank_position'],
            ]);
        }

        return $result;
    }

    private function runPythonScript(array $payload): array
    {
        $script = base_path('ml/scripts/predict_recommendations.py');
        $jsonPayload = json_encode($payload);

        $process = proc_open(
            ['python', $script, $jsonPayload],
            [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $pipes
        );

        if (!is_resource($process)) {
            throw new Exception('Unable to start recommendation process.');
        }

        $output = stream_get_contents($pipes[1]);
        $error = stream_get_contents($pipes[2]);

        fclose($pipes[1]);
        fclose($pipes[2]);

        $exitCode = proc_close($process);

        if ($exitCode !== 0) {
            throw new Exception('Recommendation script failed: ' . $error);
        }

        $result = json_decode($output, true);

        if ($result === null) {
            throw new Exception('Invalid JSON from recommendation script: ' . $output);
        }

        if (isset($result['error'])) {
            throw new Exception('Recommendation error: ' . $result['error']);
        }

        return $result;
    }
}

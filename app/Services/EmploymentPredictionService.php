<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\EmploymentPrediction;
use App\Models\PwdProfile;
use Exception;

class EmploymentPredictionService
{
    public function predict(array $profile): array
    {
        $script = base_path('ml/scripts/predict_employment_type.py');
        $payload = json_encode($profile);

        $process = proc_open(
            ['python', $script, $payload],
            [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $pipes
        );

        if (!is_resource($process)) {
            throw new Exception('Unable to start Python prediction process.');
        }

        $output = stream_get_contents($pipes[1]);
        $error = stream_get_contents($pipes[2]);

        fclose($pipes[1]);
        fclose($pipes[2]);

        $exitCode = proc_close($process);

        if ($exitCode !== 0) {
            throw new Exception('Python prediction failed: ' . $error);
        }

        $result = json_decode($output, true);

        if ($result === null) {
            throw new Exception('Invalid JSON returned from Python: ' . $output);
        }

        if (isset($result['error'])) {
            throw new Exception('Prediction error: ' . $result['error']);
        }

        return $result;
    }

    public function predictForProfile(PwdProfile $profile): array
    {
        $profile->load(['skills', 'registryReference']);

        $registry = $profile->registryReference;

        $payload = [
            'age' => $registry->age ?? 35,
            'sex' => $registry->sex ?? 'Male',
            'civil_status' => $registry->civil_status ?? 'Single',
            'disability_type' => $registry->disability_type ?? 'Visual Disability',
            'disability_visibility' => $registry->disability_visibility ?? 'Apparent',
            'cause_of_disability' => $registry->cause_of_disability ?? 'Acquired',
            'educational_attainment' => $registry->educational_attainment ?? $profile->education ?? 'College Graduate',
            'skills' => $profile->skills->pluck('skill_name')->implode(', ') ?: 'Computer data encoding',
            'mobility_status' => $registry->mobility_status ?? 'Independent',
            'current_assistive_device' => $registry->current_assistive_device ?? 'None',
            'occupation_group' => $registry->occupation_group ?? 'Clerical Support Workers',
        ];

        $result = $this->predict($payload);

        EmploymentPrediction::updateOrCreate(
            ['pwd_profile_id' => $profile->id],
            [
                'predicted_type' => $result['predicted_type'],
                'confidence' => $result['confidence'],
                'all_probabilities' => isset($result['all_probabilities'])
                    ? json_encode($result['all_probabilities'])
                    : null,
                'generated_at' => now(),
            ]
        );

        try {
            app(RecommendationService::class)->generateForProfile($profile->fresh());
        } catch (\Exception $e) {
            Log::warning('Recommendation skipped: ' . $e->getMessage());
        }

        try {
            app(RecommendationService::class)->generateForProfile($profile->fresh());
        } catch (\Exception $e) {
            Log::warning('Recommendation skipped: ' . $e->getMessage());
        }

        return $result;
    }
}

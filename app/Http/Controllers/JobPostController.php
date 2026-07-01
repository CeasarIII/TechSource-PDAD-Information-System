<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobPostController extends Controller
{
    public function index()
    {
        $employer = Auth::user()->employer;

        $jobs = JobPost::where('employer_id', $employer->id)
            ->with('skills')
            ->latest()
            ->get();

        return view('employer.jobs.index', compact('jobs', 'employer'));
    }

    public function create()
    {
        $employer = Auth::user()->employer;

        if ($employer->verification_status !== 'verified') {
            return redirect()->route('employer.dashboard')
                ->with('warning', 'Your account is pending verification. You can post jobs once verified by admin.');
        }

        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $employer = Auth::user()->employer;

        if ($employer->verification_status !== 'verified') {
            abort(403, 'Account not verified yet.');
        }

        $validated = $request->validate([
            'job_title' => 'required|string|max:200',
            'job_description' => 'required|string|max:5000',
            'employment_type' => 'required|in:Permanent,Contractual,Casual,Job Order,Probationary,Seasonal,Self-employed',
            'job_location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'required_skills' => 'nullable|string|max:1000',
            'required_level' => 'nullable|in:Beginner,Intermediate,Advanced,Expert',
        ]);

        DB::transaction(function () use ($validated, $employer) {
            $job = JobPost::create([
                'employer_id' => $employer->id,
                'job_title' => $validated['job_title'],
                'job_description' => $validated['job_description'],
                'employment_type' => $validated['employment_type'],
                'job_location' => $validated['job_location'] ?? null,
                'salary_min' => $validated['salary_min'] ?? null,
                'salary_max' => $validated['salary_max'] ?? null,
                'status' => 'open',
            ]);

            if (!empty($validated['required_skills'])) {
                $skills = array_map('trim', explode(',', $validated['required_skills']));

                foreach ($skills as $skill) {
                    if ($skill) {
                        JobSkill::create([
                            'job_post_id' => $job->id,
                            'skill_name' => $skill,
                            'required_level' => $validated['required_level'] ?? 'Intermediate',
                        ]);
                    }
                }
            }
        });

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully.');
    }

    public function edit(JobPost $job)
    {
        $this->authorizeEmployerJob($job);

        return view('employer.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPost $job)
    {
        $this->authorizeEmployerJob($job);

        $validated = $request->validate([
            'job_title' => 'required|string|max:200',
            'job_description' => 'required|string|max:5000',
            'employment_type' => 'required|in:Permanent,Contractual,Casual,Job Order,Probationary,Seasonal,Self-employed',
            'job_location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'status' => 'required|in:open,closed,draft',
        ]);

        $job->update($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    public function destroy(JobPost $job)
    {
        $this->authorizeEmployerJob($job);

        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    private function authorizeEmployerJob(JobPost $job): void
    {
        $employer = Auth::user()->employer;

        if ($job->employer_id !== $employer->id) {
            abort(403);
        }
    }
}

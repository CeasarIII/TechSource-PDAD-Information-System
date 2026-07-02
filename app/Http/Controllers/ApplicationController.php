<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPost;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function apply(JobPost $job)
    {
        $profile = Auth::user()->pwdProfile;

        if (!$profile) {
            return redirect()->route('pwd.profile.create')
                ->with('warning', 'Complete your profile before applying.');
        }

        $alreadyApplied = Application::where('pwd_profile_id', $profile->id)
            ->where('job_post_id', $job->id)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('warning', 'You have already applied for this job.');
        }

        Application::create([
            'pwd_profile_id' => $profile->id,
            'job_post_id' => $job->id,
            'status' => 'applied',
            'applied_at' => now(),
        ]);

        return back()->with('success', 'Application submitted successfully.');
    }

    public function employerIndex()
    {
        $employer = Auth::user()->employer;

        $applications = Application::with([
            'pwdProfile.user',
            'jobPost',
        ])
            ->whereHas('jobPost', function ($query) use ($employer) {
                $query->where('employer_id', $employer->id);
            })
            ->latest()
            ->get();

        return view('employer.applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'application_status' => 'required|in:applied,under_review,shortlisted,interview,accepted,rejected,withdrawn',
            'employer_notes' => 'nullable|string|max:1000',
        ]);

        $employer = Auth::user()->employer;

        if ($application->jobPost->employer_id !== $employer->id) {
            abort(403);
        }

        $oldStatus = $application->status;
        $newStatus = $request->application_status;

        $application->update([
            'status' => $newStatus,
            'employer_notes' => $request->employer_notes,
            'status_updated_at' => now(),
        ]);

        $application->loadMissing(['pwdProfile.user', 'jobPost']);

        if ($oldStatus !== $newStatus && $application->pwdProfile?->user) {
            Notification::create([
                'user_id' => $application->pwdProfile->user_id,
                'type' => 'application_status',
                'title' => 'Application Status Updated',
                'message' => 'Your application for ' . $application->jobPost->job_title . ' is now ' . ucwords(str_replace('_', ' ', $newStatus)) . '.',
                'data' => [
                    'application_id' => $application->id,
                    'job_post_id' => $application->job_post_id,
                    'job_title' => $application->jobPost->job_title,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                ],
            ]);
        }

        return back()->with('success', 'Application status updated.');
    }
}

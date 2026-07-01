<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPost;
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
            'application_status' => 'Pending',
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
            'application_status' => 'required|in:Pending,Interview,Accepted,Rejected',
        ]);

        $employer = Auth::user()->employer;

        if ($application->jobPost->employer_id !== $employer->id) {
            abort(403);
        }

        $application->update([
            'application_status' => $request->application_status,
        ]);

        return back()->with('success', 'Application status updated.');
    }
}

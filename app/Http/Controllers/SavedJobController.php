<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    public function index()
    {
        $profile = Auth::user()->pwdProfile;

        if (!$profile) {
            return redirect()->route('pwd.profile.create')
                ->with('warning', 'Complete your profile before viewing saved jobs.');
        }

        $savedJobs = SavedJob::with('jobPost')
            ->where('pwd_profile_id', $profile->id)
            ->latest('saved_at')
            ->get();

        return view('jobs.saved', compact('savedJobs'));
    }

    public function store(JobPost $job)
    {
        $profile = Auth::user()->pwdProfile;

        if (!$profile) {
            return redirect()->route('pwd.profile.create')
                ->with('warning', 'Complete your profile before saving jobs.');
        }

        SavedJob::firstOrCreate(
            [
                'pwd_profile_id' => $profile->id,
                'job_post_id' => $job->id,
            ],
            [
                'saved_at' => now(),
            ]
        );

        return back()->with('success', 'Job saved successfully.');
    }

    public function destroy(JobPost $job)
    {
        $profile = Auth::user()->pwdProfile;

        if (!$profile) {
            return redirect()->route('pwd.profile.create')
                ->with('warning', 'Complete your profile first.');
        }

        SavedJob::where('pwd_profile_id', $profile->id)
            ->where('job_post_id', $job->id)
            ->delete();

        return back()->with('success', 'Job removed from saved jobs.');
    }
}

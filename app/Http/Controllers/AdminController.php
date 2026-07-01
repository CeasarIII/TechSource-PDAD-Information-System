<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Employer;
use App\Models\JobPost;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_pwd' => User::where('role', 'pwd')->count(),
            'total_employers' => User::where('role', 'employer')->count(),
            'pending_verifications' => Employer::where('verification_status', 'pending')->count(),
            'verified_employers' => Employer::where('verification_status', 'verified')->count(),
            'total_jobs' => JobPost::count(),
            'open_jobs' => JobPost::where('status', 'open')->count(),
            'total_applications' => Application::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

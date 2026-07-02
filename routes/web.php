<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicantSkillController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PwdProfileController;
use App\Http\Controllers\PwdValidationController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/terms', [TermsController::class, 'show'])
    ->middleware(['auth'])
    ->name('terms.show');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'pwd') return redirect()->route('pwd.dashboard');
    if ($user->role === 'employer') return redirect()->route('employer.dashboard');
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');

    return redirect('/');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/pwd/dashboard', function () {
        $profile = auth()->user()->pwdProfile;
        $prediction = $profile?->employmentPrediction;

        return view('pwd.dashboard', compact('profile', 'prediction'));
    })->name('pwd.dashboard');

    Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])
        ->name('employer.dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/terms/accept', [TermsController::class, 'accept'])->name('terms.accept');

    Route::get('/pwd/validate', [PwdValidationController::class, 'showForm'])->name('pwd.validate.show');
    Route::post('/pwd/validate', [PwdValidationController::class, 'validate'])->name('pwd.validate');

    Route::get('/pwd/profile/edit', [PwdProfileController::class, 'editOwn'])->name('pwd.profile.edit-own');
    Route::resource('/pwd/profile', PwdProfileController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->names('pwd.profile');

    Route::post('/pwd/skills', [ApplicantSkillController::class, 'store'])->name('pwd.skills.store');
    Route::delete('/pwd/skills/{skill}', [ApplicantSkillController::class, 'destroy'])->name('pwd.skills.destroy');

    Route::resource('/employer/jobs', JobPostController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->names('employer.jobs');

    Route::get('/jobs', function () {
        $jobs = \App\Models\JobPost::where('status', 'open')
            ->with('employer')
            ->latest()
            ->get();

        return view('jobs.index', compact('jobs'));
    })->name('jobs.index');

    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('applications.apply');

    Route::get('/employer/applications', [ApplicationController::class, 'employerIndex'])
        ->name('employer.applications.index');

    Route::patch('/employer/applications/{application}', [ApplicationController::class, 'updateStatus'])
        ->name('employer.applications.update');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.readAll');
});

Route::middleware('guest')->group(function () {
    Route::get('/employer/register', [EmployerController::class, 'showRegistration'])
        ->name('employer.register');

    Route::post('/employer/register', [EmployerController::class, 'register']);
});

require __DIR__ . '/auth.php';

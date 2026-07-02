<?php

use App\Http\Controllers\ApplicantSkillController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PwdProfileController;
use App\Http\Controllers\PwdValidationController;
use App\Http\Controllers\TermsController;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Terms
|--------------------------------------------------------------------------
*/

Route::get('/terms', [TermsController::class, 'show'])
    ->middleware('auth')
    ->name('terms.show');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = auth()->user();

    return match ($user->role) {
        'pwd'      => redirect()->route('pwd.dashboard'),
        'employer' => redirect()->route('employer.dashboard'),
        'admin'    => redirect()->route('admin.dashboard'),
        default    => redirect('/'),
    };

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboards
    |--------------------------------------------------------------------------
    */

    Route::get('/pwd/dashboard', function () {

        $profile = auth()->user()->pwdProfile;
        $prediction = $profile?->employmentPrediction;

        return view('pwd.dashboard', compact(
            'profile',
            'prediction'
        ));

    })->name('pwd.dashboard');

    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | PWD Pages
    |--------------------------------------------------------------------------
    */

    Route::get('/pwd/jobs', function () {

        $jobs = JobPost::whereIn('status', ['open', 'active'])
            ->latest()
            ->get();

        return view('pwd.jobs', compact('jobs'));

    })->name('pwd.jobs');

    Route::get('/pwd/applications', function () {

        $profile = auth()->user()->pwdProfile;

        $applications = collect();

        if ($profile) {
            $applications = Application::with('jobPost')
                ->where('pwd_profile_id', $profile->id)
                ->latest()
                ->get();
        }

        return view('pwd.applications', compact('applications'));

    })->name('pwd.applications');

    Route::get('/pwd/resume', function () {
        return view('pwd.resume');
    })->name('pwd.resume');

    Route::get('/pwd/trainings', function () {
        return view('pwd.trainings');
    })->name('pwd.trainings');

    /*
    |--------------------------------------------------------------------------
    | Button Actions
    |--------------------------------------------------------------------------
    */

    Route::post('/pwd/jobs/apply', function () {

        $user = auth()->user();
        $profile = $user->pwdProfile;

        if (!$profile) {
            return redirect()
                ->route('pwd.profile.create')
                ->with('success', 'Please complete your profile first.');
        }

        $job = JobPost::findOrFail(request('job_post_id'));

        $application = Application::firstOrCreate(
            [
                'pwd_profile_id' => $profile->id,
                'job_post_id' => $job->id,
            ],
            [
                'status' => 'applied',
                'applied_at' => now(),
                'status_updated_at' => now(),
            ]
        );

        if (! $application->wasRecentlyCreated) {
            return redirect()
                ->route('pwd.applications')
                ->with('success', 'You already applied for this job.');
        }

        /*
        |--------------------------------------------------------------------------
        | Employer Notification
        |--------------------------------------------------------------------------
        */

        $employer = DB::table('employers')
            ->where('id', $job->employer_id)
            ->first();

        if ($employer) {
            DB::table('notifications')->insert([
                'user_id' => $employer->user_id,
                'type' => 'job_application',
                'title' => 'New Job Application',
                'message' => $user->name . ' applied for ' . $job->job_title . '.',
                'data' => json_encode([
                    'application_id' => $application->id,
                    'job_post_id' => $job->id,
                    'job_title' => $job->job_title,
                    'pwd_profile_id' => $profile->id,
                    'applicant_name' => $user->name,
                ]),
                'read_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $employerUser = DB::table('users')
                ->where('id', $employer->user_id)
                ->first();

            if ($employerUser && ! empty($employerUser->email)) {
                try {
                    Mail::raw(
                        "Hello " . ($employer->contact_person ?? 'Employer') . ",\n\n" .
                        $user->name . " applied for your job post: " . $job->job_title . ".\n\n" .
                        "Applicant Email: " . $user->email . "\n" .
                        "Application Status: Applied\n\n" .
                        "Please check the PDAD Employer Dashboard for application details.\n\n" .
                        "Thank you,\nPDAD Employment Matching System",
                        function ($message) use ($employerUser, $job) {
                            $message->to($employerUser->email)
                                ->subject('New Job Application - ' . $job->job_title);
                        }
                    );
                } catch (\Throwable $e) {
                    Log::warning('Employer application email failed: ' . $e->getMessage());
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PWD Applicant Notification
        |--------------------------------------------------------------------------
        */

        DB::table('notifications')->insert([
            'user_id' => $user->id,
            'type' => 'application_submitted',
            'title' => 'Application Submitted',
            'message' => 'Your application for ' . $job->job_title . ' was submitted successfully.',
            'data' => json_encode([
                'application_id' => $application->id,
                'job_post_id' => $job->id,
                'job_title' => $job->job_title,
            ]),
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (! empty($user->email)) {
            try {
                Mail::raw(
                    "Hello " . $user->name . ",\n\n" .
                    "Your application for " . $job->job_title . " has been submitted successfully.\n\n" .
                    "Application Status: Applied\n" .
                    "Location: " . ($job->location ?? 'Not specified') . "\n" .
                    "Employment Type: " . ($job->employment_type ?? 'Not specified') . "\n\n" .
                    "Thank you,\nPDAD Employment Matching System",
                    function ($message) use ($user, $job) {
                        $message->to($user->email)
                            ->subject('Application Submitted - ' . $job->job_title);
                    }
                );
            } catch (\Throwable $e) {
                Log::warning('PWD application email failed: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('pwd.applications')
            ->with('success', 'Application submitted successfully.');

    })->name('pwd.jobs.apply');

    Route::post('/pwd/trainings/enroll', function () {

        return redirect()
            ->route('pwd.trainings')
            ->with('success', 'Successfully enrolled in training.');

    })->name('pwd.trainings.enroll');

    /*
    |--------------------------------------------------------------------------
    | Laravel Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | PWD Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/pwd/profile/edit', [PwdProfileController::class, 'editOwn'])
        ->name('pwd.profile.edit-own');

    Route::resource('/pwd/profile', PwdProfileController::class)
        ->only([
            'create',
            'store',
            'edit',
            'update',
        ])
        ->names('pwd.profile');

    /*
    |--------------------------------------------------------------------------
    | PWD Validation
    |--------------------------------------------------------------------------
    */

    Route::get('/pwd/validate', [PwdValidationController::class, 'showForm'])
        ->name('pwd.validate.show');

    Route::post('/pwd/validate', [PwdValidationController::class, 'validate'])
        ->name('pwd.validate');

    /*
    |--------------------------------------------------------------------------
    | Skills
    |--------------------------------------------------------------------------
    */

    Route::post('/pwd/skills', [ApplicantSkillController::class, 'store'])
        ->name('pwd.skills.store');

    Route::delete('/pwd/skills/{skill}', [ApplicantSkillController::class, 'destroy'])
        ->name('pwd.skills.destroy');

    /*
    |--------------------------------------------------------------------------
    | Terms
    |--------------------------------------------------------------------------
    */

    Route::post('/terms/accept', [TermsController::class, 'accept'])
        ->name('terms.accept');
});

require __DIR__ . '/auth.php';

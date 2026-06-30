<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\PwdValidationController;
use App\Http\Controllers\PwdProfileController;
use App\Http\Controllers\ApplicantSkillController;
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
    ->middleware(['auth'])
    ->name('terms.show');

/*
|--------------------------------------------------------------------------
| Main Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'pwd') {
        return redirect()->route('pwd.dashboard');
    }

    if ($user->role === 'employer') {
        return redirect()->route('employer.dashboard');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect('/');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/pwd/dashboard', function () {
        $profile = auth()->user()->pwdProfile;
        $prediction = $profile?->employmentPrediction;

        return view('pwd.dashboard', compact('profile', 'prediction'));
    })->name('pwd.dashboard');

    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pwd/profile/edit', [PwdProfileController::class, 'editOwn'])
        ->name('pwd.profile.edit-own');

    Route::post('/terms/accept', [TermsController::class, 'accept'])
        ->name('terms.accept');

    Route::get('/pwd/validate', [PwdValidationController::class, 'showForm'])
        ->name('pwd.validate.show');

    Route::post('/pwd/validate', [PwdValidationController::class, 'validate'])
        ->name('pwd.validate');

    Route::resource('/pwd/profile', PwdProfileController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->names('pwd.profile');

    Route::post('/pwd/skills', [ApplicantSkillController::class, 'store'])
        ->name('pwd.skills.store');

    Route::delete('/pwd/skills/{skill}', [ApplicantSkillController::class, 'destroy'])
        ->name('pwd.skills.destroy');
});

require __DIR__ . '/auth.php';
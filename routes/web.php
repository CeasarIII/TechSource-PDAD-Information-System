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

Route::get('/terms', [TermsController::class, 'show'])
    ->middleware(['auth'])
    ->name('terms.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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

Route::get('/pwd/dashboard', function () {
    return view('pwd.dashboard');
})->middleware(['auth']);

Route::get('/employer/dashboard', function () {
    return view('employer.dashboard');
})->middleware(['auth']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth']);

require __DIR__ . '/auth.php';

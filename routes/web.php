<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PremiumController;
use App\Livewire\Projects\Manage;
use App\Livewire\Projects\Show;
use App\Livewire\Public\Index;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('home');
Route::get('/showcase', Index::class)->name('showcase');

Route::get('/dashboard/projects', Manage::class)->middleware('auth')->name('projects.manage');
Route::get('/showcase/{project}', Show::class)->name('projects.show');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware('auth')->group(function () {
    Route::get('/premium/upgrade', [PremiumController::class, 'showUpgrade'])->name('premium.upgrade');
    Route::post('/premium/initiate', [PremiumController::class, 'initiatePremium'])->name('premium.initiate');
    Route::get('/premium/callback', [PremiumController::class, 'handleCallback'])->name('premium.callback');
    Route::get('/premium/thank-you', [PremiumController::class, 'thankYou'])->name('premium.thank-you');
});

Route::get('/auth/redirect', [SocialAuthController::class, 'redirectToGoogle']);

Route::get('/auth/google/callback', [SocialAuthController::class, 'handelGoogleCallback']);



require __DIR__ . '/auth.php';

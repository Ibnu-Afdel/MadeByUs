<?php

use App\Livewire\Projects\Manage;
use App\Livewire\Projects\Show;
use App\Livewire\Public\Index;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('home');

Route::get('/projects', Manage::class)->middleware('auth')->name('projects.manage');
Route::get('/projects/{project}', Show::class)->middleware('auth')->name('projects.show');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});


require __DIR__ . '/auth.php';

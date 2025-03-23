<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\JobOfferForm;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('myOffers', 'MyOffers')
    ->middleware(['auth'])
    ->name('MyOffers');

Route::view('myOffers/create', 'job-offers.create')
    ->middleware(['auth'])
    ->name('job-offers.create');

Route::view('myTeam', 'MyTeam')
    ->middleware(['auth'])
    ->name('MyTeam');

require __DIR__ . '/auth.php';

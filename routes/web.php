<?php

use App\Http\Controllers\JobOfferController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobOfferController::class, 'index'])
    ->name('job-offers.index');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('empleos', 'job-offers.index-guest')
    ->name('empleos');

Route::view('myOffers', 'MyOffers')
    ->middleware(['auth'])
    ->name('MyOffers');

Route::view('myOffers/show/{offer}/users-applies', 'user-applies.index')
    ->middleware(['auth'])
    ->name('user-applies.index');

Route::view('myOffers/create', 'job-offers.create')
    ->middleware(['auth'])
    ->name('job-offers.create');

Route::get('myOffers/show/{offer}', [JobOfferController::class, 'show'])
    ->middleware(['auth'])
    ->name('job-offers.show');

Route::view('myTeam', 'MyTeam')
    ->middleware(['auth'])
    ->name('MyTeam');

require __DIR__ . '/auth.php';

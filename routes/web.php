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

Route::view('company/{company}/myOffers', 'MyOffers')
    ->middleware(['auth'])
    ->name('MyOffers');

Route::view('company/{company}/myOffers/show/{offer}/users-applies', 'user-applies.index')
    ->middleware(['auth'])
    ->name('user-applies.index');

Route::view('myOffers/create', 'job-offers.create')
    ->middleware(['auth'])
    ->name('job-offers.create');

Route::view('company/create', 'company.create')
    ->middleware(['auth'])
    ->name('company.create');

Route::view('company', 'company.index')
    ->middleware(['auth'])
    ->name('company.index');

Route::view('company/{company}/myOffers/show/{offer}', 'job-offers.show')
    ->middleware(['auth'])
    ->name('job-offers.show');

Route::view('myTeam', 'MyTeam')
    ->middleware(['auth'])
    ->name('MyTeam');

require __DIR__ . '/auth.php';

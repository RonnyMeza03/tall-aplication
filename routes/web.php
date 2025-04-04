<?php

use App\Http\Controllers\JobOfferController;
use App\Livewire\Calendar;
use App\Livewire\Dashboard;
use App\Livewire\JobFinder;
use App\Livewire\MyTeam;
use App\Livewire\UserProfile;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobOfferController::class, 'index'])
    ->name('job-offers.index');


Route::get('dashboard', Dashboard::class)
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

Route::view('company/{company}/myOffers/create', 'job-offers.create')
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

Route::get('myTeam', MyTeam::class)
    ->middleware(['auth'])
    ->name('MyTeam');

Route::get('/calendar', Calendar::class)
    ->middleware(['auth'])
    ->name('calendar');

Route::get('user/empleos', JobFinder::class)
    ->middleware(['auth'])
    ->name('user.empleos');

Route::get('user/profile', UserProfile::class)
    ->middleware(['auth'])
    ->name('user.profile');

Route::get('user/profile/{user}', UserProfile::class)
    ->middleware(['auth'])
    ->name('user.profile.show');

require __DIR__ . '/auth.php';

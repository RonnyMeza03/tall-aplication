<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use App\Models\JobOffer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;

class JobOfferForm extends Component
{
    public $layout = 'layouts.app'; // apunta a resources/views/layouts/app.blade.php
    public $jobTitle;
    public $description;
    public $minSalary;
    public $maxSalary;
    public $mode;
    public $workingHours;
    public $currency;
    public $company_id;
    public $country_id;
    public $user_id;
    public $expiresAt;

    public function submit()
    {
        $this->user_id = Auth::user()->id;
        $this->company_id = Auth::user()->company[0]->id;
        Log::info('User ID: ' . $this->user_id);
        Log::info('Company ID: ' . $this->company_id);

        $this->validate([
            'jobTitle' => 'required',
            'description' => 'required',
            'minSalary' => 'required',
            'maxSalary' => 'required',
            'mode' => 'required',
            'workingHours' => 'required',
            'currency' => 'required',
            'country_id' => 'required',
            'expiresAt' => 'required',
        ]);

        JobOffer::create([
            'isActive' => true,
            'jobTitle' => $this->jobTitle,
            'description' => $this->description,
            'minSalary' => $this->minSalary,
            'maxSalary' => $this->maxSalary,
            'mode' => $this->mode,
            'workingHours' => $this->workingHours,
            'currency' => $this->currency,
            'company_id' => $this->company_id,
            'country_id' => $this->country_id,
            'user_id' => $this->user_id,
            'expiresAt' => $this->expiresAt,
        ]);

        session()->flash('message', 'Job Offer Created Successfully.');

        $this->reset();
    }

    public function render()
    {
        $countries = Country::all()->pluck('name', 'id');
        return view('livewire.job-offer-form')->with(['layout' => $this->layout, 'countries' => $countries]);
    }
}

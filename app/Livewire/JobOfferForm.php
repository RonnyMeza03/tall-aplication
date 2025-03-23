<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use App\Models\JobOffer;
use Illuminate\Container\Attributes\Log;
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
    public $companyId;
    public $countryId;
    public $userId;
    public $expiresAt;

    public function submit()
    {
        $this->userId = Auth::user()->id;
        $this->companyId = Auth::user()->company->id;

        $this->validate([
            'jobTitle' => 'required',
            'description' => 'required',
            'minSalary' => 'required',
            'maxSalary' => 'required',
            'mode' => 'required',
            'workingHours' => 'required',
            'currency' => 'required',
            'companyId' => 'required',
            'countryId' => 'required',
            'userId' => 'required',
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
            'companyId' => $this->companyId,
            'countryId' => $this->countryId,
            'userId' => $this->userId,
            'expiresAt' => $this->expiresAt,
        ]);

        session()->flash('message', 'Job Offer Created Successfully.');

        $this->reset();
    }

    public function render()
    {
        $countryList = Country::all();
        return view('livewire.job-offer-form')->with(['layout' => $this->layout, 'countryList' => $countryList]);
    }
}

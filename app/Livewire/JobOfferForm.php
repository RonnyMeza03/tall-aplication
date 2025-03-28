<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use App\Models\JobOffer;
use App\Models\Tag;
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
    public $offerTags = [];
    public $selectedTag = '';
    public $companyIdRequest;

    // Define el layout específicamente
    public function layout()
    {
        return 'layouts.app'; // Apunta al archivo que ya tienes creado
    }

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->companyIdRequest = request()->route('company');
    }

    public function submit()
    {
        $this->user_id = Auth::user()->id;
        $this->company_id = $this->companyIdRequest;

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

        $newOffer = JobOffer::create([
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
            'expires_at' => $this->expiresAt,
        ]);

        $newOffer->tags()->attach($this->offerTags);

        session()->flash('message', 'Job Offer Created Successfully.');

        $redirectUrlId = $this->companyIdRequest;

        $this->reset();

        return redirect()->route('MyOffers' , ['company' => $redirectUrlId]);
    }

    public function addTag()
    {
        if (!empty($this->selectedTag) && !in_array($this->selectedTag, $this->offerTags)) {
            $this->offerTags[] = $this->selectedTag;
            $this->selectedTag = ''; // Reset for the next selection
        }
    }

    public function removeTag($index)
    {
        unset($this->offerTags[$index]);
        $this->offerTags = array_values($this->offerTags); // Re-index the array
    }

    public function render()
    {
        $countries = Country::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('livewire.job-offer-form')->with(['layout' => $this->layout, 'countries' => $countries, 'tags' => $tags]);
    }
}

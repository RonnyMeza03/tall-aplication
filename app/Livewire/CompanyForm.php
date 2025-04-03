<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Country;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CompanyForm extends Component
{
    use WithFileUploads;
    public $layout = 'layouts.guest'; // apunta a resources/views/layouts/guest.blade.php
    public $name;
    public $description;
    public $address;
    public $email;
    public $logo;
    public $website;
    public $country_id;

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'email' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'required',
            'country_id' => 'required',
        ]);

        $logoPath = $this->logo->store('logos', 'public');

        $newCompany = Company::create([
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'email' => $this->email,
            'logo' => $logoPath,
            'website' => $this->website,
            'country_id' => $this->country_id,
        ]);

        // Get the current authenticated user
        $user = Auth::user();
        
        // Attach the user to the newly created company
        // You can also pass additional pivot data if needed
        $newCompany->users()->attach($user->id, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Company created successfully.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        $countries = Country::all()->pluck('name', 'id');
        return view('livewire.company-form')->with(['layout' => $this->layout, 'countries' => $countries]);
    }
}

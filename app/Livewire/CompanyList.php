<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CompanyList extends Component
{

    public $layout = 'layouts.app'; // apunta a resources/views/layouts/app.blade.php

    public function render()
    {
        $userCompanies = Auth::user()->company;

        foreach ($userCompanies as $company) 
        {
            $company->logo = asset('storage/' . $company->logo);
        }

        return view('livewire.company-list')->with(['layout' => $this->layout, 'userCompanies' => $userCompanies]);
    }
}

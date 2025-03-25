<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyList extends Component
{

    public $layout = 'layouts.app'; // apunta a resources/views/layouts/app.blade.php

    public function render()
    {
        $userCompanies = Auth::user()->company;
        return view('livewire.company-list')->with(['layout' => $this->layout, 'userCompanies' => $userCompanies]);
    }
}

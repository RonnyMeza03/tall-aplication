<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyTeam extends Component
{
    public $email = '';
    public $selectedCompanyId = '';

    public function inviteUser()
    {
        $this->validate([
            'email' => 'required|email',
            'selectedCompanyId' => 'required|exists:companies,id',
        ]);

        $user = User::where('email', $this->email)->first();

        $user->company()->attach($this->selectedCompanyId);

        // Limpiar campos
        $this->email = '';
        $this->selectedCompanyId = '';
        
        // Mensaje de éxito
        session()->flash('message', 'Invitación enviada correctamente');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $userCompanies = Auth::user()->company;

        return view('livewire.my-team')->with(['userCompanies' => $userCompanies]);
    }
}

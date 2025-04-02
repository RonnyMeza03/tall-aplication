<?php

namespace App\Livewire;

use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserProfile extends Component
{

    #[Layout('layouts.app')]
    public function render()
    {
        $userProfile = Auth::user()->perfil;
        return view('livewire.user-profile')->with([
            'userProfile' => $userProfile,
        ]);
    }
}

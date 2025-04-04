<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

class Login extends Component
{
    public LoginForm $form;
    public string $title = 'Acceso';

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // Check if the user has company
        if (count(Auth::user()->company))
        {
            // Redirect to the company dashboard
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } 
        else
        {
            // Redirect to the user dashboard
            $this->redirectIntended(default: route('user.empleos', absolute: false), navigate: true);
        }
    }

    public function render(): mixed
    {
        return view('livewire.pages.auth.login')
            ->layout('layouts.guest', ['title' => $this->title]);
    }
};
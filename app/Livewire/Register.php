<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Volt\Component;
use App\Models\Country;

class Register extends Component 
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $country_id = '';
    public $countries = [];
    public $title = 'Registro';

    protected function countries()
    {
        $countries = Country::orderBy('name')->pluck('name', 'id');

        return $countries;
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'country_id' => ['required', 'exists:countries,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        $user->perfil()->create(['role' => 'user', 'phone' => '', 'url' => route('user.profile.show', $user->id)]);

        Auth::login($user);

        $this->redirect(route('user.empleos', absolute: false), navigate: true);
    }

    public function mount(): void
    {
        $this->countries = $this->countries();
    }

    public function render(): mixed
    {
        return view('livewire.pages.auth.register')
            ->layout('layouts.guest', ['title' => $this->title]);
    }
};
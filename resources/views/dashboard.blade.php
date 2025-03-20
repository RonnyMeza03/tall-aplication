<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;


$user_name = Auth::user() ? Auth::user()->name : 'Usuario no autenticado';
$user_role = Auth::user() ? Auth::user()->perfil->role : 'Usuario no autenticado';

?>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Bienvenido {{$user_role}} {{ $user_name }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JobFinder - Portal de Empleos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased font-sans bg-gray-100 dark:bg-gray-900">
    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-sm sticky top-0 shadow-sm">
        <div class="flex items-center justify-between gap-2 py-4 lg:grid-cols-3 w-full max-w-7xl mx-auto px-6 lg:px-8 ">
            <a href="/" wire:navigate class="flex items-center gap-2">
                <img src="/jobFinderLogo.png" alt="Logo de la app" class="size-10 shadow-sm rounded-md">
                <h1 class="text-2xl font-bold text-rose-600 dark:text-rose-800 hidden sm:block">JobFinder</h1>
            </a>
            @if (Route::has('login'))
                <div class="flex justify-end items-center space-x-4">
                    @auth
                        <a 
                            href="{{ url('/dashboard') }}"
                            wire:navigate
                            class="text-gray-600 dark:text-gray-300 font-medium hover:text-rose-600 dark:hover:text-rose-400"
                        >
                            Panel de control
                        </a>
                    @else
                        <a 
                            href="{{ route('login') }}"
                            wire:navigate
                            class="text-gray-600 dark:text-gray-300 hover:text-rose-600 hover:underline hover:underline-offset-2 dark:hover:text-rose-800">
                            Iniciar sesión
                        </a>
                        @if (Route::has('register'))
                            <a 
                                href="{{ route('register') }}"
                                wire:navigate
                                class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 dark:bg-rose-700 text-white rounded-md hover:bg-rose-700 dark:hover:bg-rose-900">
                                Registrarse
                                <x-icons.log-in class="size-5" />
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>
<div>
    <livewire:job-finder />
</div>
@livewireScripts
</body>

</html>
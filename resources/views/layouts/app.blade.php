<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles()
    </head>
    <body class="font-sans antialiased">
        <div class="h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            @if (count(Auth::user()->company) > 0)
                <div class="flex flex-1 bg-gray-800 dark:bg-gray-900 overflow-hidden">
                    <livewire:layout.sidebar />
                    <main class="flex-1 overflow-auto p-4 bg-gray-100 dark:bg-gray-900">
                        {{ $slot }}
                    </main>
                </div>
            @else
                <div class="flex flex-1 bg-gray-800 dark:bg-gray-900 overflow-hidden">
                    <main class="flex-1 overflow-auto p-4 bg-gray-100 dark:bg-gray-900">
                        {{ $slot }}
                    </main>
                </div>
            @endif
        </div>
        @livewireScripts()
    </body>
</html>
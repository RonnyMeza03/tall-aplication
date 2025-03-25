<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal de Empleos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>

<body class="antialiased font-sans">
    <div class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-white">
        <div class="relative min-h-screen flex flex-col">
            <!-- Barra de navegación -->
            <header class="grid grid-cols-2 items-center gap-2 py-6 lg:grid-cols-3 max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex lg:justify-center lg:col-start-2">
                    <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">JobFinder</h1>
                </div>
                @if (Route::has('login'))
                    <div class="flex justify-end items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Iniciar
                                sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">Registrarse</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </header>

            <!-- Contenido principal -->
            <main class="flex-grow">
                <!-- Hero Section -->
                <section
                    class="relative bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900">
                    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24">
                        <div class="max-w-3xl">
                            <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                                Encuentra el trabajo de tus sueños
                            </h2>
                            <p class="mt-6 text-xl text-blue-100">
                                Miles de ofertas de empleo te esperan. Conectamos a los mejores talentos con las
                                empresas más innovadoras.
                            </p>
                            <div class="mt-8">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                                    <form class="flex flex-col md:flex-row gap-4">
                                        <div class="flex-grow">
                                            <input type="text" name="search"
                                                placeholder="¿Qué trabajo estás buscando?"
                                                class="w-full px-4 py-3 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="flex-grow">
                                            <input type="text" name="location" placeholder="Ubicación"
                                                class="w-full px-4 py-3 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <button type="submit"
                                            class="px-6 py-3 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 font-medium">
                                            Buscar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Categorías de empleo -->
                <section class="max-w-7xl mx-auto px-6 py-12">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Categorías populares</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @php
                            $categories = [
                                [
                                    'icon' =>
                                        'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                                    'name' => 'Desarrollo Web',
                                    'count' => 357,
                                    'color' => 'blue',
                                ],
                                [
                                    'icon' =>
                                        'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                                    'name' => 'Marketing Digital',
                                    'count' => 289,
                                    'color' => 'green',
                                ],
                                [
                                    'icon' =>
                                        'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
                                    'name' => 'Diseño UX/UI',
                                    'count' => 215,
                                    'color' => 'purple',
                                ],
                                [
                                    'icon' =>
                                        'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z',
                                    'name' => 'Atención al Cliente',
                                    'count' => 183,
                                    'color' => 'red',
                                ],
                            ];
                        @endphp

                        @foreach ($categories as $category)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                <div
                                    class="w-12 h-12 bg-{{ $category['color'] }}-100 dark:bg-{{ $category['color'] }}-900 rounded-lg flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-{{ $category['color'] }}-600 dark:text-{{ $category['color'] }}-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $category['icon'] }}" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    {{ $category['name'] }}</h4>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $category['count'] }} empleos
                                    disponibles</p>
                                <a href="#"
                                    class="text-{{ $category['color'] }}-600 dark:text-{{ $category['color'] }}-400 hover:text-{{ $category['color'] }}-800 dark:hover:text-{{ $category['color'] }}-300 font-medium">Ver
                                    empleos →</a>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Empleos destacados -->
                <section class="bg-gray-100 dark:bg-gray-800">
                    <div class="max-w-7xl mx-auto px-6 py-12">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Empleos destacados</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse ($jobsOffers as $job)
                                <div
                                    class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-12 w-12 bg-blue-200 dark:bg-blue-800 rounded-md flex items-center justify-center">
                                            <span
                                                class="text-blue-700 dark:text-blue-300 font-bold">{{ substr($job->jobTitle, 0, 2) }}</span>
                                        </div>
                                        <div class="ml-4 flex-grow">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                                                {{ $job->jobTitle }}</h4>
                                            <p class="text-gray-700 dark:text-gray-300 mb-2">
                                                {{ $job->company->name ?? 'Empresa' }} • {{ $job->country->name ?? 'Remoto' }}
                                            </p>
                                            <div class="flex flex-wrap gap-2 mb-3">
                                                @if (isset($job->skills))
                                                    @foreach (explode(',', $job->skills) as $skill)
                                                        <span
                                                            class="px-2 py-1 text-xs bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">{{ trim($skill) }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span
                                                    class="text-gray-600 dark:text-gray-300">{{ $job->minSalary ?? 'Salario a convenir' }} {{$job->currency}} - {{$job->maxSalary}} {{$job->currency}}</span>
                                                <span
                                                    class="text-sm text-gray-500 dark:text-gray-400">{{ $job->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-8">
                                    <p class="text-gray-600 dark:text-gray-300">No hay ofertas de trabajo disponibles en
                                        este momento.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-10 text-center">
                            <a href="{{route('empleos')}}" wire:navigate
                                class="inline-block px-6 py-3 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 font-medium">Ver
                                todos los empleos</a>
                        </div>
                    </div>
                </section>

                <!-- CTA Empresas -->
                <section class="bg-blue-600 dark:bg-blue-800">
                    <div class="max-w-7xl mx-auto px-6 py-12">
                        <div class="md:flex md:items-center md:justify-between">
                            <div class="md:max-w-2xl">
                                <h3 class="text-2xl font-bold text-white mb-4">¿Eres una empresa buscando talento?</h3>
                                <p class="text-blue-100 mb-6">Publica tus ofertas de empleo y encuentra a los mejores
                                    profesionales para tu equipo. Miles de candidatos cualificados esperan tu oferta.
                                </p>
                            </div>
                            <div class="mt-6 md:mt-0">
                                <a href="{{route('company.create')}}" wire:navigate
                                    class="inline-block px-6 py-3 bg-white text-blue-600 rounded-md hover:bg-gray-100 font-medium">Publicar
                                    oferta</a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <!-- Footer -->
            <footer class="py-16 text-center text-sm text-black dark:text-white/70 bg-gray-800 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-left mb-10">
                        <div>
                            <h4 class="text-white text-lg font-semibold mb-4">JobFinder</h4>
                            <p class="text-gray-400">Conectando talentos con oportunidades desde 2023.</p>
                        </div>
                        <div>
                            <h5 class="text-white text-md font-semibold mb-4">Para candidatos</h5>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-white">Buscar empleos</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white">Crear perfil</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white">Alertas de empleo</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="text-white text-md font-semibold mb-4">Para empresas</h5>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-white">Publicar empleo</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white">Búsqueda de
                                        candidatos</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white">Soluciones de
                                        reclutamiento</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="text-white text-md font-semibold mb-4">Contáctanos</h5>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-white">Soporte</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white">Acerca de</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </footer>
        </div>
    </div>
    @livewireScripts()
</body>

</html>
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans">
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto"
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                        alt="">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <div class="relative">
                    <button type="button" id="btnDropdown"
                        class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900" aria-expanded="false">
                        Product
                        <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!--
          'Product' flyout menu, show/hide based on flyout menu state.

          Entering: "transition ease-out duration-200"
            From: "opacity-0 translate-y-1"
            To: "opacity-100 translate-y-0"
          Leaving: "transition ease-in duration-150"
            From: "opacity-100 translate-y-0"
            To: "opacity-0 translate-y-1"
        -->
                    <div id="menuDrop"
                        class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white ring-1 shadow-lg ring-gray-900/5 hidden">
                        <div class="p-4">
                            <div
                                class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div
                                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                                    </svg>
                                </div>
                                <div class="flex-auto">
                                    <a href="#" class="block font-semibold text-gray-900">
                                        Analytics
                                        <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-gray-600">Get a better understanding of your traffic</p>
                                </div>
                            </div>
                            <div
                                class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div
                                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
                                    </svg>
                                </div>
                                <div class="flex-auto">
                                    <a href="#" class="block font-semibold text-gray-900">
                                        Engagement
                                        <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-gray-600">Speak directly to your customers</p>
                                </div>
                            </div>
                            <div
                                class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div
                                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                                    </svg>
                                </div>
                                <div class="flex-auto">
                                    <a href="#" class="block font-semibold text-gray-900">
                                        Security
                                        <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-gray-600">Your customers’ data will be safe and secure</p>
                                </div>
                            </div>
                            <div
                                class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div
                                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </div>
                                <div class="flex-auto">
                                    <a href="#" class="block font-semibold text-gray-900">
                                        Integrations
                                        <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-gray-600">Connect with third-party tools</p>
                                </div>
                            </div>
                            <div
                                class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div
                                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </div>
                                <div class="flex-auto">
                                    <a href="#" class="block font-semibold text-gray-900">
                                        Automations
                                        <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-gray-600">Build strategic funnels that will convert</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                            <a href="#"
                                class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100">
                                <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Watch demo
                            </a>
                            <a href="#"
                                class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100">
                                <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Contact sales
                            </a>
                        </div>
                    </div>
                </div>

                <a href="#" class="text-sm/6 font-semibold text-gray-900">Features</a>
                <a href="#" class="text-sm/6 font-semibold text-gray-900">Marketplace</a>
                <a href="#" class="text-sm/6 font-semibold text-gray-900">Company</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif
            </div>
        </nav>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" role="dialog" aria-modal="true">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div class="fixed inset-0 z-10"></div>
            <div
                class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                            src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                            alt="">
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <div class="-mx-3">
                                <button type="button"
                                    class="flex w-full items-center justify-between rounded-lg py-2 pr-3.5 pl-3 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                    aria-controls="disclosure-1" aria-expanded="false">
                                    Product
                                    <!--
                  Expand/collapse icon, toggle classes based on menu open state.

                  Open: "rotate-180", Closed: ""
                -->
                                    <svg class="size-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <!-- 'Product' sub-menu, show/hide based on menu state. -->
                                <div class="mt-2 space-y-2" id="disclosure-1">
                                    <a href="#"
                                        class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Analytics</a>
                                    <a href="#"
                                        class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Engagement</a>
                                    <a href="#"
                                        class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Security</a>
                                    <a href="#"
                                        class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Integrations</a>
                                    <a href="#"
                                        class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Automations</a>
                                    <a href="#"
                                        class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Watch
                                        demo</a>
                                    <a href="#"
                                        class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Contact
                                        sales</a>
                                </div>
                            </div>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Features</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Marketplace</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Company</a>
                        </div>
                        <div class="py-6">
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log
                                in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
          <div class="relative left-[calc(50%-11rem)] aspect-1155/678 w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
          <div class="hidden sm:mb-8 sm:flex sm:justify-center">
            <div class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
              Announcing our next round of funding. <a href="#" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
            </div>
          </div>
          <div class="text-center">
            <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">Data to enrich your online business</h1>
            <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
              <a href="#" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
              <a href="#" class="text-sm/6 font-semibold text-gray-900">Learn more <span aria-hidden="true">→</span></a>
            </div>
          </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
          <div class="relative left-[calc(50%+3rem)] aspect-1155/678 w-[36.125rem] -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
      </div>

    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>


</body>

</html> --}}

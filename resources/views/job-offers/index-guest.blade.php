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
    <header class="bg-white dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 13.255A10.5 10.5 0 0112 4.5 10.5 10.5 0 012.95 13.255a1 1 0 00-.895.553 1 1 0 00.895 1.447A10.5 10.5 0 0112 19.5a10.5 10.5 0 019.05-4.245 1 1 0 00.895-1.447 1 1 0 00-.895-.553z" />
                        </svg>
                        JobFinder
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 w-64" placeholder="Cargo, aptitud o empresa">
                        <div class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="text" class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 w-40" placeholder="Colombia">
                        <div class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        <div class="flex justify-end items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                                    Dashboard
                                </a>
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full">
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                                    Iniciar sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
<div>
    <livewire:job-finder />
</div>
    <!-- Main Content Area - Include Livewire Component -->
    

    {{-- <!-- Main Content Area with Split View -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Side - Job Listings -->
            <div class="w-full lg:w-2/5 bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                        Principales empleos que te recomendamos
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        En función de tu perfil, preferencias y actividad como solicitudes, búsquedas y contenido guardado.
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ count($jobsOffers) }} resultados
                    </p>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($jobsOffers as $index => $jobOffer)
                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition @if(request()->get('selected') == $jobOffer->id) bg-blue-50 dark:bg-blue-900 border-l-4 border-blue-500 @endif">
                            <a href="{{ route('job-offers.index-guest', ['selected' => $jobOffer->id]) }}" class="block">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-4">
                                        @if($jobOffer->company && $jobOffer->company->logo)
                                            <img src="{{ $jobOffer->company->logo }}" alt="{{ $jobOffer->company->name }}" class="h-12 w-12 object-cover rounded">
                                        @else
                                            <div class="h-12 w-12 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-900 dark:text-white">{{ $jobOffer->jobTitle }}</h3>
                                        @if($jobOffer->company)
                                            <p class="text-gray-600 dark:text-gray-300">{{ $jobOffer->company->name }}</p>
                                        @endif
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            @if($jobOffer->country)
                                                {{ $jobOffer->country->name }} 
                                            @endif
                                            @if($jobOffer->jobType)
                                                · {{ $jobOffer->jobType }}
                                            @endif
                                        </p>
                                        <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                            <span>Publicado {{ $jobOffer->created_at->diffForHumans() }}</span>
                                            @if($jobOffer->applications_count)
                                                <span class="ml-2">· {{ $jobOffer->applications_count }} solicitudes</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if(!request()->get('selected') || request()->get('selected') != $jobOffer->id)
                                        <button class="ml-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Side - Job Details -->
            <div class="w-full lg:w-3/5">
                @if(request()->has('selected'))
                    @php
                        $selectedJob = $jobsOffers->firstWhere('id', request()->get('selected'));
                    @endphp
                    @if($selectedJob)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                            <!-- Job Header -->
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $selectedJob->jobTitle }}</h1>
                                        <div class="mt-2">
                                            @if($selectedJob->company)
                                                <p class="text-lg text-gray-700 dark:text-gray-300">{{ $selectedJob->company->name }}</p>
                                            @endif
                                            <p class="text-gray-600 dark:text-gray-400">
                                                @if($selectedJob->country)
                                                    {{ $selectedJob->country->name }}
                                                @endif
                                                @if($selectedJob->jobType)
                                                    · {{ $selectedJob->jobType }}
                                                @endif
                                                @if($selectedJob->created_at)
                                                    · Publicado {{ $selectedJob->created_at->diffForHumans() }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                            </svg>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex flex-wrap gap-2">
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A10.5 10.5 0 0112 4.5 10.5 10.5 0 012.95 13.255a1 1 0 00-.895.553 1 1 0 00.895 1.447A10.5 10.5 0 0112 19.5a10.5 10.5 0 019.05-4.245 1 1 0 00.895-1.447 1 1 0 00-.895-.553z" />
                                        </svg>
                                        @if($selectedJob->jobType)
                                            <span>{{ $selectedJob->jobType }}</span>
                                        @else
                                            <span>Tiempo completo</span>
                                        @endif
                                    </div>
                                    
                                    @if($selectedJob->minSalary)
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $selectedJob->minSalary }} @if($selectedJob->maxSalary) - {{ $selectedJob->maxSalary }} @endif</span>
                                        </div>
                                    @endif

                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>
                                            @if($selectedJob->country)
                                                {{ $selectedJob->country->name }}
                                            @else
                                                Ubicación no especificada
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Solicitar ahora
                                    </a>
                                    <button class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Job Details -->
                            <div class="p-6">
                                <div class="prose dark:prose-invert max-w-none">
                                    <h2 class="text-xl font-semibold mb-4 dark:text-white">Descripción del empleo</h2>
                                    <div class="text-gray-700 dark:text-gray-300">
                                        @if($selectedJob->description)
                                            {!! nl2br(e($selectedJob->description)) !!}
                                        @else
                                            <p>No hay descripción disponible para este empleo.</p>
                                        @endif
                                    </div>
                                    
                                    @if($selectedJob->requirements)
                                        <h2 class="text-xl font-semibold mt-8 mb-4">Requisitos</h2>
                                        <div class="text-gray-700 dark:text-gray-300">
                                            {!! nl2br(e($selectedJob->requirements)) !!}
                                        </div>
                                    @endif
                                    
                                    @if($selectedJob->benefits)
                                        <h2 class="text-xl font-semibold mt-8 mb-4">Beneficios</h2>
                                        <div class="text-gray-700 dark:text-gray-300">
                                            {!! nl2br(e($selectedJob->benefits)) !!}
                                        </div>
                                    @endif
                                    
                                    <h2 class="text-xl font-semibold mt-8 mb-4 dark:text-white">Acerca de la empresa</h2>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-4">
                                            @if($selectedJob->company && $selectedJob->company->logo)
                                                <img src="{{ $selectedJob->company->logo }}" alt="{{ $selectedJob->company->name }}" class="h-16 w-16 object-cover rounded">
                                            @else
                                                <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            @if($selectedJob->company)
                                                <h3 class="font-medium text-gray-900 dark:text-white">{{ $selectedJob->company->name }}</h3>
                                                <p class="text-gray-600 dark:text-gray-400">{{ $selectedJob->company->description ?? 'Sin descripción disponible' }}</p>
                                            @else
                                                <p class="text-gray-600 dark:text-gray-400">Información de la empresa no disponible</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8 text-center">
                            <p class="text-gray-600 dark:text-gray-400">Selecciona una oferta de trabajo para ver los detalles</p>
                        </div>
                    @endif
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-4 text-gray-600 dark:text-gray-400">Selecciona una oferta de trabajo para ver los detalles</p>
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
</body>

</html>
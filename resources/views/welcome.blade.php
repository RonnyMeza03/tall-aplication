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
            <header class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 shadow-sm z-50">
                <div class="flex items-center justify-between gap-2 py-4 lg:grid-cols-3 w-full max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="flex items-center gap-2">
                        <img src="/jobFinderLogo.png" alt="Logo de la app" class="size-10 shadow-sm rounded-md">
                        <h1 class="text-2xl font-bold text-rose-600 dark:text-rose-800 hidden sm:block">JobFinder</h1>
                    </div>
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

            <!-- Contenido principal -->
            <main class="flex-grow">
                <!-- Hero Section -->
                <section
                    class="relative bg-gradient-to-r from-rose-800 to-rose-300 dark:from-rose-800 dark:to-rose-950">
                    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24">
                        <div class="max-w-4xl">
                            <h2 class="text-4xl font-bold text-white sm:text-7xl">
                                Encuentra el trabajo de tus sueños
                            </h2>
                            <p class="mt-6 text-xl text-gray-200">
                                Miles de ofertas de empleo te esperan. Conectamos a los mejores talentos con las
                                empresas más innovadoras.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Categorías de empleo -->
                <section class="max-w-7xl mx-auto px-6 py-12">
                    <h3 class="text-4xl font-semibold text-gray-900 dark:text-white mb-8">Categorías populares</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @php
                        use App\Models\Tag;
                        use App\Models\JobOffer;
                           $categories = Tag::with(['jobTag' => function ($query) {
                               $query->where('isActive', true);
                           }])->get()->map(function ($category) {
                               return [
                                   'name' => $category->name,
                                   'count' => $category->jobTag->count(),
                                   'color' => $category->color,
                                   'logo' => $category->logo,
                               ];
                           })->sortByDesc('count')->take(4)->values();
                        @endphp

                        @foreach ($categories as $category)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                <div
                                    class="w-12 h-12 bg-{{ $category['color'] }}-100 dark:bg-{{ $category['color'] }}-900 rounded-lg flex items-center justify-center mb-4">
                                    @if ($category['logo'])
                                        <img class="h-6 w-6" 
                                             src="{{ asset('storage'. $category['logo']) }}" 
                                             alt="{{ $category['name'] }}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 text-{{ $category['color'] }}-600 dark:text-{{ $category['color'] }}-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <!-- Default icon if no logo -->
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    @endif
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
                <section class="">
                    <div class="max-w-7xl mx-auto px-6 py-12">
                        <h3 class="text-4xl font-semibold text-gray-900 dark:text-white mb-8">Empleos destacados</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse ($jobsOffers as $job)
                                <div
                                    class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-12 w-12 bg-rose-200 dark:bg-rose-800 rounded-md flex items-center justify-center">
                                            <span
                                                class="text-rose-700 dark:text-rose-300 font-bold">{{ substr($job->jobTitle, 0, 2) }}</span>
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
                                class="inline-flex items-center gap-2 px-6 py-3 bg-rose-600 dark:bg-rose-700 text-white rounded-md hover:bg-rose-700 dark:hover:bg-rose-800 font-medium"
                            >
                                Ver todos los empleos
                                <x-icons.square-arrow-out-up-right class="size-5" />
                            </a>
                        </div>
                    </div>
                </section>

                <!-- CTA Empresas -->
                <section class="bg-rose-300 dark:bg-rose-800">
                    <div class="max-w-7xl mx-auto px-6 py-12">
                        <div class="md:flex md:items-center md:justify-between">
                            <div class="md:max-w-2xl">
                                <h3 class="text-4xl font-bold text-white mb-4">¿Eres una empresa buscando talento?</h3>
                                <p class="text-gray-200 mb-6">Publica tus ofertas de empleo y encuentra a los mejores
                                    profesionales para tu equipo. Miles de candidatos cualificados esperan tu oferta.
                                </p>
                            </div>
                            <div class="mt-6 md:mt-0">
                                <a href="{{route('company.create')}}" wire:navigate
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-white text-rose-600 rounded-md hover:bg-gray-100 font-medium">
                                    Publicar oferta
                                    <x-icons.briefcase-bussines class="size-5" />
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <!-- Footer -->
            <footer class="py-16 text-center text-sm bg-rose-800 dark:bg-rose-950">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-left mb-10">
                        <div>
                            <h4 class="text-white text-2xl font-semibold mb-4">JobFinder</h4>
                            <p class="text-gray-200">Conectando talentos con oportunidades desde 2023.</p>
                        </div>
                        <div>
                            <h5 class="text-white text-lg font-semibold mb-4">Para candidatos</h5>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-200 hover:text-white">Buscar empleos</a></li>
                                <li><a href="#" class="text-gray-200 hover:text-white">Crear perfil</a></li>
                                <li><a href="#" class="text-gray-200 hover:text-white">Alertas de empleo</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="text-white text-lg font-semibold mb-4">Para empresas</h5>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-200 hover:text-white">Publicar empleo</a></li>
                                <li><a href="#" class="text-gray-200 hover:text-white">Búsqueda de
                                        candidatos</a></li>
                                <li><a href="#" class="text-gray-200 hover:text-white">Soluciones de
                                        reclutamiento</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="text-white text-lg font-semibold mb-4">Contáctanos</h5>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-200 hover:text-white">Soporte</a></li>
                                <li><a href="#" class="text-gray-200 hover:text-white">Acerca de</a></li>
                                <li><a href="#" class="text-gray-200 hover:text-white">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class="text-white">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </p>
                </div>
            </footer>
        </div>
    </div>
    @livewireScripts()
</body>

</html>
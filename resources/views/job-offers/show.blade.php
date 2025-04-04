<?php

    use App\Models\JobOffer;
    
    $offerId  = request()->route('offer');
    $companyId = request()->route('company');
    $offer = JobOffer::find($offerId);

?>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Header con título y botones de acción -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $offer->jobTitle }}</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Publicado el {{ \Carbon\Carbon::parse($offer->created_at)->format('d/m/Y') }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex space-x-3">
                        {{-- <a href="{{ route('job-offers.edit', $offer->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Editar
                        </a> --}}
                        {{-- <form method="POST" action="{{ route('job-offers.destroy', $offer->id) }}" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition" onclick="return confirm('¿Estás seguro de que deseas eliminar esta oferta?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Eliminar
                            </button>
                        </form> --}}
                        <a href="{{ route('MyOffers', ['company' => $companyId, 'offer' => $offer]) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Volver
                        </a>

                        <a href="{{ route('user-applies.index', ['company' => $companyId, 'offer' => $offer]) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-blue-600 active:bg-blue-700 dark:active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 00-1 1v12a1 1 0 001 1h6a1 1 0 001-1V7.414a1 1 0 00-.293-.707l-5-5A1 1 0 0010.586 2H9zm1 2.414L14.586 8H11a1 1 0 01-1-1V4.414z" />
                                <path d="M3 8a1 1 0 011-1h4a1 1 0 010 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h4a1 1 0 010 2H4a1 1 0 01-1-1zm1 3a1 1 0 100 2h10a1 1 0 100-2H4z" />
                            </svg>
                            Ver candidaturas
                        </a>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="p-6 bg-white dark:bg-gray-800">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Información principal -->
                        <div class="md:col-span-2 space-y-6">
                            <!-- Sección de descripción -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Descripción del puesto</h3>
                                <div class="prose max-w-none dark:prose-invert prose-gray prose-sm">
                                    <p class="text-gray-600 dark:text-gray-300">{{ $offer->description }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar con información resumida -->
                        <div class="space-y-6">
                            <!-- Información resumida -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden">
                                <div class="bg-blue-600 dark:bg-blue-700 p-4">
                                    <h3 class="text-lg font-semibold text-white">Detalles del puesto</h3>
                                </div>
                                <div class="p-4 space-y-4">
                                    <!-- Salario -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Salario</p>
                                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ number_format($offer->minSalary, 0, ',', '.') }} - {{ number_format($offer->maxSalary, 0, ',', '.') }} {{$offer->currency}}</p>
                                        </div>
                                    </div>

                                    <!-- Modalidad -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Modalidad</p>
                                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $offer->mode }}</p>
                                        </div>
                                    </div>

                                    <!-- Ubicación (podría ser un campo adicional) -->
                                    @if(isset($offer->country))
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Ubicación</p>
                                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $offer->country->name }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Tipo de contrato (podría ser un campo adicional) -->
                                    @if(isset($offer->workingHours))
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Tipo de contrato</p>
                                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $offer->workingHours }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Fecha de expiración -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Fecha límite</p>
                                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($offer->expiresAt)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Estadísticas (esto sería información adicional) -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <h3 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-3">Estadísticas</h3>
                                <div class="space-y-2">
                                    {{-- <div class="flex justify-between">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Visualizaciones:</span>
                                        <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $offer->views ?? 0 }}</span>
                                    </div> --}}
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Candidaturas:</span>
                                        <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $offer->users()->count() ?? 0 }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Días activa:</span>
                                        <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($offer->created_at)->diffInDays(now()) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
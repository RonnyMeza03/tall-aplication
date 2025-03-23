<?php

use App\Models\JobOffer;
use Illuminate\Support\Facades\Auth;

$offers = JobOffer::where('user_id', Auth::user()->id)->get();

?>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Mis Ofertas de Empleo</h2>
                    <a href="{{route('job-offers.create')}}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-150 ease-in-out">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Crear oferta
                        </span>
                    </a>
                </div>
                
                <div class="p-6 bg-white dark:bg-gray-800">
                    @if ($offers->isEmpty())
                        <div class="flex items-center justify-center p-6 text-center">
                            <div class="max-w-md">
                                <div class="text-gray-400 dark:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="mt-4 text-lg font-medium">No hay ofertas todavía</p>
                                    <p class="mt-2">Crea tu primera oferta de empleo para comenzar a recibir candidatos.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($offers as $offer)
                                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                    <div class="p-4 bg-blue-600 dark:bg-blue-700 text-white">
                                        <h3 class="text-lg font-semibold truncate">{{ $offer->jobTitle }}</h3>
                                    </div>
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 h-12">{{ $offer->description }}</p>
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-2 mb-4">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ $offer->mode }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                                    {{ \Carbon\Carbon::parse($offer->expiresAt)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-100 dark:bg-gray-600 rounded p-2 mb-4">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Salario:</p>
                                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">
                                                {{ number_format($offer->minSalary, 0, ',', '.') }} - {{ number_format($offer->maxSalary, 0, ',', '.') }} €
                                            </p>
                                        </div>
                                        
                                        <div class="flex justify-end space-x-2">
                                            {{-- <a href="{{ route('job-offers.edit', $offer->id) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 dark:bg-blue-800 dark:text-blue-100 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Editar
                                            </a> --}}
                                            <a href="{{ route('job-offers.show', $offer) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                Ver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
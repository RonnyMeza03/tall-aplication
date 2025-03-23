<?php

use App\Models\JobOffer;
use Illuminate\Support\Facades\Auth;

$offers = JobOffer::where('userId', Auth::id())->get();

?>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Offers</p>
                </div>
                <a href="{{route("job-offers.create")}}">Crear oferta</a>
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    @if ($offers->isEmpty())
                        <p class="text-white">No hay ofertas</p>
                    @else
                        @foreach ($offers as $offer)
                            <p class="text-white">{{ $offer->title }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

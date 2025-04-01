@props([
    'barchartData' => [],
])

<div 
    {{ $attributes->merge(['class' => "bg-white rounded-lg px-6 py-6 shadow-xs hover:shadow-lg transition duration-300 ease-in-out space-y-4 dark:bg-gray-800 dark:shadow-none dark:hover:shadow-none"]) }}
>
    <div class="flex items-center justify-between gap-4 w-full">
        <p class="font-medium text-gray-700 line-clamp-2 dark:text-gray-400">Top ofertas con mayor numero de solicitudes esta semana.</p>
        <div class="rounded-full bg-gray-100 p-2">
            <x-icons.chart-column-decreasing />
        </div>
    </div>

    @if(count($barchartData['categories']) > 0 && count($barchartData['series']['data']) > 0)
        <div 
            x-data="initChart()"
            x-init="init({{ json_encode($barchartData) }})"
            wire:ignore
            class="w-full h-92"
        ></div>
    @else
        <div class="w-full grid grid-cols-1 place-items-center gap-4 py-12">
            <x-icons.chart-column-decreasing class="w-16 h-16 text-gray-300" />
            <p class="text-gray-500">No hay datos disponibles</p>
        </div>
    @endif
</div>
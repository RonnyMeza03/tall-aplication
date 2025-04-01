@props([
    'title' => 'Título',
    'icon' => null,
    'count' => 'Conteo'
])

<section class="bg-white py-6 px-12 text-center rounded-lg shadow-xs hover:shadow-lg transition duration-300 ease-in-out grid place-items-center grid-cols-1 gap-2 dark:bg-gray-800 dark:shadow-none dark:hover:shadow-none">
    <div class="bg-gray-100 p-2 rounded-full">
        @if($icon)
            <x-dynamic-component :component="$icon" />
        @else
            <x-icons.user />
        @endif
    </div>
    <p class="font-medium line-clamp-2 text-gray-700 dark:text-gray-500">{{ $title }}</p>
    <h4 class="text-5xl font-bold dark:text-white">{{ $count }}</h4>
</section>
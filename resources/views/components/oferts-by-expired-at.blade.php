@props([
    'jobOffers' => [],
])

<div
    {{ $attributes->merge(['class' => 'overflow-hidden w-full overflow-x-auto bg-white rounded-lg p-6 shadow-xs hover:shadow-lg duration-300 transition-all ease-in-out space-y-4 dark:bg-gray-800 dark:shadow-none dark:hover:shadow-none']) }}    
>
    <div class="w-full flex items-center justify-between gap-4">
        <p class="text-gray-700 dark:text-gray-400 font-medium">Listado de ofertas proximas a expirar.</p>
        <div class="bg-gray-100 rounded-full p-2">
            <x-icons.table />
        </div>
    </div>
    @if (count($jobOffers) > 0)
        <table class="w-full text-left text-sm">
            <thead class="border-b border-gray-400 text-sm dark:text-white">
                <tr>
                    <th scope="col" class="p-4">Empresa</th>
                    <th scope="col" class="p-4">Oferta</th>
                    <th scope="col" class="p-4">Descripción</th>
                    <th scope="col" class="p-4">Solicitudes</th>
                    <th scope="col" class="p-4">Expira el </th>
                </tr>
            </thead>
            @foreach ($jobOffers as $offer)
                <tbody class="divide-y divide-outline divide-gray-300 dark:divide-outline-dark overflow-hidden">
                    <tr>
                        <td class="p-4">
                            <div class="flex w-max items-center gap-2">
                                <img class="size-10 rounded-full object-cover" src="{{ asset('storage/'. $offer->company->logo ) }}" alt="user avatar" />
                                <div class="flex flex-col">
                                    <span class="text-neutral-900 dark:text-white">{{ $offer->company->name }}</span>
                                    <span class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">{{ $offer->company->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 dark:text-gray-400">{{ $offer->jobTitle }}</td>
                        <td class="p-4 truncate dark:text-gray-400">{{ Str::limit($offer->description, 20, '...')  }}</td>
                        <td class="p-4">
                            <div class="inline-flex items-center gap-4 dark:text-gray-400">
                                <x-icons.user class="w-5 h-5 text-gray-400 dark:text-gray-600" />
                                {{ $offer->total_users_applied }}
                            </div>
                        </td>
                        <td class="p-4 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($offer->expires_at)->format('d-m-Y') }}
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        <!-- Pagination Controls -->
        {{-- <div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button wire:click="previousPage" 
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                        {{ $currentPage <= 1 ? 'disabled' : '' }}>
                        Anterior
                    </button>
                    <button wire:click="nextPage" 
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                        {{ $currentPage >= $totalPages ? 'disabled' : '' }}>
                        Siguiente
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Mostrando página <span class="font-medium">{{ $currentPage }}</span> de <span class="font-medium">{{ $totalPages }}</span>
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button wire:click="previousPage"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700"
                                {{ $currentPage <= 1 ? 'disabled' : '' }}>
                                <span class="sr-only">Anterior</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <button wire:click="goToPage({{ $i }})"
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium {{ $currentPage == $i ? 'text-blue-600 dark:text-blue-400 z-10 border-blue-500 dark:border-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                    {{ $i }}
                                </button>
                            @endfor

                            <button wire:click="nextPage"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700"
                                {{ $currentPage >= $totalPages ? 'disabled' : '' }}>
                                <span class="sr-only">Siguiente</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}
    @else
        <div class="w-full grid grid-cols-1 place-items-center gap-4 py-12">
            <x-icons.circle-help class="w-20 h-20 text-gray-400 dark:text-gray-600" />
            <p class="text-gray-500 dark:text-gray-400">No hay ofertas proximas a expirar.</p>
        </div>
    @endif
</div>

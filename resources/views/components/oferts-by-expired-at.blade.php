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
                                <img class="size-10 rounded-full object-cover" src="{{ $offer->company->logo }}" alt="user avatar" />
                                <div class="flex flex-col">
                                    <span class="text-neutral-900 dark:text-white">{{ $offer->company->name }}</span>
                                    <span class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">{{ $offer->company->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 dark:text-gray-400">{{ $offer->jobTitle }}</td>
                        <td class="p-4 truncate dark:text-gray-400">{{ $offer->description }}</td>
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
    @else
        <div class="w-full grid grid-cols-1 place-items-center gap-4 py-12">
            <x-icons.circle-help class="w-20 h-20 text-gray-400 dark:text-gray-600" />
            <p class="text-gray-500 dark:text-gray-400">No hay ofertas proximas a expirar.</p>
        </div>
    @endif
</div>

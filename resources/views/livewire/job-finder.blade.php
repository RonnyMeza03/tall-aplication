<div class="w-full mt-10 sm:mt-0 max-w-screen h-full px-4 min-h-[calc(100vh-4.5rem)] grid grid-cols-1 justify-center items-center">
    <div class="w-full mx-auto max-w-[100rem] grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-y-4 gap-x-40">
        @if($selectedJob)
            <div class="grid grid-cols-1 gap-x-10 gap-y-3 lg:grid-cols-[1fr_auto] items-center">
                {{-- <div class="w-full h-50 lg:w-[20rem] xl:w-[27.5rem] 2xl:w-[35rem] bg-red-300 lg:h-[27rem] 2xl:h-[37.5rem] rounded-lg shadow-md hover:shadow-xl object-cover transition-all duration-300 ease-in-out overflow-hidden group">
                    <img 
                        src="https://vault-html-tailwind.vercel.app/images/online-2.png" 
                        alt="Imagen de empleo"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-600 ease-in-out"
                    >
                </div> --}}
                <div class="grid grid-cols-1 items-center">
                    <div class="block">
                        @if($selectedJob->company)
                            <span class="border-l-3 pl-2 border-rose-600 text-2xl text-rose-800 font-semibold">
                                {{ $selectedJob->company->name }}
                            </span>
                        @endif
                        
                        <h2 class="text-5xl leading-14 2xl:leading-20 2xl:text-7xl font-bold text-gray-900 dark:text-white">
                            {{ $selectedJob->jobTitle }}
                        </h2>
                        <h4 class="text-lg text-gray-800 dark:text-gray-400 mt-8 sm:max-w-[70%] font-medium line-clamp-3">
                            @if($selectedJob->description)
                                {!! nl2br(e($selectedJob->description)) !!}
                            @else
                                <p>No hay descripción disponible para este empleo.</p>
                            @endif
                        </h4>
                        <p class="mt-2 text-gray-600 text-sm">
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
                        @if(count($selectedJob->tags) > 0)
                            <div class="flex items-start flex-wrap gap-2 mt-6">
                                @foreach ($selectedJob->tags as $tag)
                                    <span class="rounded-full bg-rose-200 text-rose-900 font-medium px-2 py-1 text-xs">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-6">
                            @if ($userApplies->contains('job_offer_id', $selectedJob->id))
                                <button class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-sm text-white cursor-not-allowed">
                                    Ya te has postulado
                                </button>
                            @else
                                <button
                                    type="button"
                                    wire:click="openModal"
                                    class="inline-flex items-center group gap-2 mt-6 bg-rose-600 text-white font-semibold text-lg px-6 py-2 rounded-full cursor-pointer hover:bg-rose-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg"
                                >
                                    Postularse
                                    <x-icons.file-plus-2 class="size-5 group-hover:rotate-45 transition-all duration-300 ease-in-out" />
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>                    
        @else
            <div class="grid grid-cols-1 gap-x-10 gap-y-3 lg:grid-cols-[35rem_1fr]">
                <div class="w-full h-[37.5rem] bg-gray-300 dark:bg-gray-800 flex items-center justify-center rounded-lg shadow-md hover:shadow-xl object-cover transition-all duration-300 ease-in-out overflow-hidden group">
                    <x-icons.image class="size-50 stroke-1 text-gray-400" />
                </div>
                <div class="grid grid-cols-1 items-center">
                    <div class="block">
                        <div class="flex items-center gap-2">
                            <div class="h-8 border-l-3 border-gray-400 dark:border-gray-700 text-2xl"></div>
                            <div class="h-8 w-60 bg-gray-300 dark:bg-gray-800 rounded-md"></div>
                        </div>
                        <div class="h-12 w-96 bg-gray-300 dark:bg-gray-800 rounded-md mt-6"></div>
                        <div class="space-y-2 mt-8">
                            <div class="h-5 w-[32rem] bg-gray-300 dark:bg-gray-800 rounded-md"></div>
                            <div class="h-5 w-[24rem] bg-gray-300 dark:bg-gray-800 rounded-md"></div>
                        </div>
                        <div class="flex items-start flex-wrap gap-2 mt-6">
                            <span class="rounded-full bg-gray-300 dark:bg-gray-800 h-6 w-40"></span>
                            <span class="rounded-full bg-gray-300 dark:bg-gray-800 h-6 w-40"></span>
                            <span class="rounded-full bg-gray-300 dark:bg-gray-800 h-6 w-40"></span>
                        </div>
                        <button
                            type="button"
                            disabled
                            class="inline-flex items-center group gap-2 mt-6 bg-rose-600 disabled:cursor-not-allowed disabled:bg-rose-600/60 disabled:hover:bg-rose-600/60 dark:disabled:bg-rose-800/50 dark:disabled:hover:bg-rose-800/50 text-white dark:text-white/50 font-semibold text-lg px-6 py-2 rounded-full cursor-pointer hover:bg-rose-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg"
                        >
                            Postularse
                            <x-icons.file-plus-2 class="size-5 transition-all duration-300 ease-in-out" />
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <div class="grid grid-cols-1 grid-rows-[auto_1fr_auto] overflow-hidden max-h-[calc(100vh-5rem)] p-4 bg-white dark:bg-gray-800 rounded-lg shadow-xl hover:shadow-2xl lg:w-[22.5rem] border-2 border-rose-400 dark:border-rose-800 transition-all duration-200 ease-in-out">
            <div class="overflow-hidden bg-rose-600 text-white rounded-lg px-3 py-3 border-2 border-gray-100 dark:border-gray-700">
                <h4 class="truncate font-medium text-lg text-center">Empleos recomendados</h4>
            </div>
            <div class="overflow-hidden w-full max-h-full mt-2">
                <div class="divide-y divide-gray-200 dark:divide-gray-700 h-full overflow-y-auto">
                    @foreach ($jobOffers as $index => $jobOffer)
                        <div wire:key="job-{{ $jobOffer->id }}" 
                            class="p-4 dark:hover:bg-gray-700 transition cursor-pointer
                            @if($selectedJobId == $jobOffer->id) bg-rose-100 hover:bg-rose-100 dark:bg-rose-900 border-l-4 border-l-rose-500 @else hover:bg-rose-50 @endif"
                            wire:click="loadJobDetails({{ $jobOffer->id }}); $nextTick(() => { window.scrollTo({ top: 0, behavior: 'smooth' }); })"
                        >
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    @if($jobOffer->company && $jobOffer->company->logo)
                                        <img src="{{ asset('storage/'. $jobOffer->company->logo) }}" alt="{{ $jobOffer->company->name }}" class="h-12 w-12 object-cover rounded">
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
                                        @if($jobOffer->mode)
                                            · {{ $jobOffer->mode }}
                                        @endif
                                    </p>
                                    <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                        <span>Publicado {{ $jobOffer->created_at->diffForHumans() }}</span>
                                        @if($jobOffer->applications_count)
                                            <span class="ml-2">· {{ $jobOffer->applications_count }} solicitudes</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
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
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium {{ $currentPage == $i ? 'text-rose-600 dark:text-rose-400 z-10 border-rose-500 dark:border-rose-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
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
            </div>
        </div>
    </div>
    
    <!-- Application Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-black/80 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>
                
                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                    Postularse para: {{ $selectedJob->jobTitle }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Complete el siguiente formulario para enviar su solicitud a {{ $selectedJob->company ? $selectedJob->company->name : 'esta empresa' }}.
                                    </p>
                                </div>
                                
                                <!-- Application Form -->
                                <form wire:submit.prevent="submitApplication({{$selectedJob->id}})" class="mt-4 space-y-4">
                                    {{-- <!-- Full Name -->
                                    <div>
                                        <label for="fullName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre completo</label>
                                        <input type="text" wire:model="fullName" id="fullName" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        @error('fullName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div> --}}
                                    
                                    <!-- Email -->
                                    {{-- <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo electrónico</label>
                                        <input type="email" wire:model="email" id="email" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div> --}}
                                    
                                    <!-- Phone -->
                                    {{-- <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                                        <input type="text" wire:model="phone" id="phone" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div> --}}

                                    <div>
                                        <label for="userUrl" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Url</label>
                                        <input type="text" wire:model="userUrl" id="userUrl" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        @error('userUrl') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- presentation -->
                                    <div>
                                        <label for="presentation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Carta de presentación (opcional)</label>
                                        <textarea wire:model="presentation" id="presentation" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                        @error('presentation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Resume Upload -->
                                    <div>
                                        <label for="resume" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Currículum (PDF, DOC, DOCX)</label>
                                        <div class="mt-1 flex items-center">
                                            <input type="file" wire:model="resume" id="resume" class="sr-only">
                                            <label for="resume" class="relative cursor-pointer bg-white dark:bg-gray-800 py-2 px-3 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Seleccionar archivo</span>
                                            </label>
                                            <p class="ml-3 text-xs text-gray-500 dark:text-gray-400">
                                                @if($resume)
                                                    {{ $resume->getClientOriginalName() }}
                                                @else
                                                    Ningún archivo seleccionado
                                                @endif
                                            </p>
                                        </div>
                                        @error('resume') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        @if ($resume)
                                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Enviar solicitud
                                            </button>
                                        @else
                                            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-400 text-base font-medium text-white cursor-not-allowed sm:ml-3 sm:w-auto sm:text-sm">
                                                Enviar solicitud
                                            </button>
                                        @endif
                                        <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="fixed bottom-0 right-0 m-6 p-4 bg-green-500 text-white rounded shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('message') }}
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="fixed bottom-0 right-0 m-6 p-4 bg-red-500 text-white rounded shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('error') }}
        </div>
    @endif
</div>
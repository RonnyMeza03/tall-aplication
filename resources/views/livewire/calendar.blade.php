<div style="margin-top: 2%; margin-left: 2%; margin-right: 2%" class="px-4 py-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
    <div class="p-2 md:p-4">
        <!-- Calendar Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 space-y-2 md:space-y-0">
            <div class="flex space-x-2">
                <button wire:click="previousMonth" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button wire:click="nextMonth" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $monthName }} {{ $year }}</h2>
            <button wire:click="currentMonth" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition dark:bg-blue-700 dark:hover:bg-blue-800">
                Hoy
            </button>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-1">
            <!-- Days of week -->
            @foreach(['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                <div class="text-center font-semibold py-2 border-b dark:border-gray-700 dark:text-gray-300">
                    {{ $day }}
                </div>
            @endforeach

            <!-- Calendar days -->
            @foreach($calendarDays as $day)
                <div wire:key="day-{{ $day['date'] }}" 
                     class="h-auto min-h-[100px] max-h-[150px] border p-1 
                            {{ $day['isToday'] ? 'bg-blue-50 border-blue-300 dark:bg-blue-900/30 dark:border-blue-700' : '' }} 
                            {{ $day['isCurrentMonth'] ? '' : 'bg-gray-50 text-gray-400 dark:bg-gray-900/30 dark:text-gray-500' }}
                            dark:border-gray-700">
                    
                    <div class="flex justify-between items-start">
                        <span class="font-medium 
                                   {{ $day['isToday'] ? 'bg-blue-600 text-white dark:bg-blue-700 rounded-full w-6 h-6 flex items-center justify-center' : 'dark:text-gray-300' }}">
                            {{ \Carbon\Carbon::parse($day['date'])->format('j') }}
                        </span>
                        
                        @if(count($day['events']) > 0)
                            <span class="text-xs bg-blue-600 dark:bg-blue-700 text-white px-1.5 rounded-full">
                                {{ count($day['events']) }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Events for this day -->
                    <div class="mt-1 space-y-1">
                        @foreach($day['events'] as $event)
                            <div wire:click="showEvent({{ $event['id'] }})" 
                                 class="px-1 py-0.5 text-xs rounded truncate cursor-pointer hover:opacity-80 transition"
                                 style="background-color: {{ $event['color'] }}; color: {{ $event['textColor'] }}">
                                {{ $event['jobTitle'] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Event Modal -->
    @if($selectedEvent)
    <div class="fixed inset-0 bg-black/80 flex items-center justify-center z-50" 
         style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px);">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                @if($isEditing)
                    <input type="text" wire:model.defer="selectedEvent.jobTitle" class="text-lg font-bold w-full dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                @else
                    <h3 class="text-lg font-bold dark:text-white">{{ $selectedEvent['jobTitle'] }}</h3>
                @endif
                <button wire:click="closeEventModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-3">
                <div class="dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">Fecha de expiracion:</span>
                    @if($isEditing)
                        <input type="date" wire:model.defer="selectedEvent.dateExp" class="ml-1 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                    @else
                        <span class="ml-1">{{ \Carbon\Carbon::parse($selectedEvent['dateExp'])->format('d/m/Y') }}</span>
                    @endif
                </div>
                
                <div class="dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">Empresa:</span>
                    @if($isEditing)
                        <input type="text" wire:model.defer="selectedEvent.company" class="ml-1 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                    @else
                        <span class="ml-1">{{ $selectedEvent['company'] }}</span>
                    @endif
                </div>
                
                <div class="dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">Ubicación:</span>
                    @if($isEditing)
                        <select wire:model.defer="selectedEvent.country_id" class="ml-1 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded">
                            <option value="{{$selectedEvent['country_id']}}">{{$selectedEvent['location']}}</option>
                            @foreach($countries as $id => $country)
                                <option value="{{$id}}">{{$country}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" wire:model.defer="selectedEvent.location" class="ml-1 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" /> --}}
                    @else
                        <span class="ml-1">{{ $selectedEvent['location'] }}</span>
                    @endif
                </div>
                
                <div class="dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">Modalidad:</span>
                    @if($isEditing)
                        <input type="text" wire:model.defer="selectedEvent.mode" class="ml-1 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                    @else
                        <span class="ml-1">{{ $selectedEvent['mode'] }}</span>
                    @endif
                </div>
                
                <div class="dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">Horario:</span>
                    @if($isEditing)
                        <input type="text" wire:model.defer="selectedEvent.workingHours" class="ml-1 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                    @else
                        <span class="ml-1">{{ $selectedEvent['workingHours'] }}</span>
                    @endif
                </div>
                
                <div class="dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">Salario:</span>
                    @if($isEditing)
                        <div class="ml-1 flex space-x-1 items-center">
                            <input type="text" wire:model.defer="selectedEvent.currency" class="w-16 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                            <input type="number" wire:model.defer="selectedEvent.minSalary" class="w-20 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                            <span>-</span>
                            <input type="number" wire:model.defer="selectedEvent.maxSalary" class="w-20 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded" />
                        </div>
                    @else
                        <span class="ml-1">{{ $selectedEvent['currency'] }} {{ $selectedEvent['minSalary'] }} - {{ $selectedEvent['maxSalary'] }}</span>
                    @endif
                </div>
                
                <div class="dark:text-gray-200">
                    <div class="flex items-center mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span class="text-gray-600 dark:text-gray-400">Descripción:</span>
                    </div>
                    @if($isEditing)
                        <div class="pl-7">
                            <textarea wire:model.defer="selectedEvent.description" class="w-full h-32 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded"></textarea>
                        </div>
                    @else
                        <div class="pl-7 max-h-32 overflow-y-auto text-justify break-words">
                            {{ $selectedEvent['description'] }}
                        </div>
                    @endif
                </div>
                
                <div class="dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">Estado:</span>
                    @if($isEditing)
                        <select wire:model.defer="selectedEvent.isActive" class="ml-1 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 rounded">
                            <option value="true">Activa</option>
                            <option value="false">Inactiva</option>
                        </select>
                    @else
                        <span class="ml-1 px-2 py-0.5 rounded-full text-xs" style="background-color: {{ $selectedEvent['color'] }}; color: {{ $selectedEvent['textColor'] }}">
                            {{ $selectedEvent['isActive'] ? 'Activa' : 'Inactiva' }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-2">
                @if($isEditing)
                    <button wire:click="saveEvent" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition dark:bg-green-700 dark:hover:bg-green-800">
                        Guardar
                    </button>
                    <button wire:click="cancelEdit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition dark:bg-gray-700 dark:hover:bg-gray-800">
                        Cancelar
                    </button>
                @else
                    <button wire:click="toggleEditMode" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition dark:bg-blue-700 dark:hover:bg-blue-800">
                        Editar
                    </button>
                    <button wire:click="deleteEvent({{ $selectedEvent['id'] }})" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition dark:bg-red-700 dark:hover:bg-red-800">
                        Eliminar
                    </button>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

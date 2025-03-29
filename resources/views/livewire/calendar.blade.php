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
                                {{ $event['title'] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Event Modal -->
    @if($selectedEvent)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold dark:text-white">{{ $selectedEvent['title'] }}</h3>
                <button wire:click="closeEventModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-3">
                <div class="dark:text-gray-200">
                    <span class="text-gray-600 dark:text-gray-400">Fecha:</span>
                    <span>{{ \Carbon\Carbon::parse($selectedEvent['date'])->format('d/m/Y') }}</span>
                </div>
                <div class="dark:text-gray-200">
                    <span class="text-gray-600 dark:text-gray-400">Hora:</span>
                    <span>{{ $selectedEvent['time'] }}</span>
                </div>
                <div class="dark:text-gray-200">
                    <span class="text-gray-600 dark:text-gray-400">Descripción:</span>
                    <p>{{ $selectedEvent['description'] }}</p>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-2">
                <button wire:click="editEvent({{ $selectedEvent['id'] }})" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition dark:bg-blue-700 dark:hover:bg-blue-800">
                    Editar
                </button>
                <button wire:click="deleteEvent({{ $selectedEvent['id'] }})" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition dark:bg-red-700 dark:hover:bg-red-800">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>

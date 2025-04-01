<div x-data="{ openModal: false, selectedCompany: null }">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Mis Empresas</h1>
        <button 
            @click="openModal = true" 
            class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm flex items-center transition-colors duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
            </svg>
            Invitar Usuario
        </button>
    </div>
    
    <div class="space-y-4" x-data="{ openCompany: null }">
        @foreach ($userCompanies as $index => $company)
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                <!-- Accordion Header -->
                <button 
                    @click="openCompany = openCompany === {{ $index }} ? null : {{ $index }}"
                    class="w-full px-4 py-3 flex justify-between items-center bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                >
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img src="{{asset('storage/' . $company->logo)}}" alt="Logo de {{$company->name}}" class="w-10 h-10 rounded-full object-cover border border-gray-200 dark:border-gray-600">
                        </div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $company->name }}</h2>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">({{ count($company->users) }} miembros)</span>
                    </div>
                    <svg 
                        x-bind:class="openCompany === {{ $index }} ? 'transform rotate-180' : ''"
                        class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-transform duration-200" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <!-- Accordion Content with User Table -->
                <div 
                    x-show="openCompany === {{ $index }}" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="px-4 py-3"
                >
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Usuario</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Rol</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                                @foreach ($company->users as $user)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $user->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100">
                                                Recruiter
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Modal para invitar usuarios -->
    <div 
        x-show="openModal" 
        x-cloak 
        class="fixed inset-0 z-50 overflow-y-auto"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay de fondo -->
            <div class="fixed inset-0 bg-black opacity-50" @click="openModal = false"></div>
            
            <!-- Contenido de la modal -->
            <div 
                class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-auto p-6 z-10"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
            >
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Invitar Nuevo Usuario</h2>
                    <button @click="openModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form wire:submit.prevent="inviteUser" class="space-y-4">
                    <!-- Email del usuario -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Correo Electrónico
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            wire:model.defer="email" 
                            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="correo@ejemplo.com"
                            required
                        >
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Selector de empresa -->
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Seleccionar Empresa
                        </label>
                        <select 
                            id="company" 
                            wire:model.defer="selectedCompanyId" 
                            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                            <option value="">Selecciona una empresa</option>
                            @foreach ($userCompanies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedCompanyId') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <button 
                            type="button" 
                            @click="openModal = false" 
                            class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Cancelar
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Invitar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

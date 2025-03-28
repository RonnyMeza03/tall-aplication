<?php
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Country;
    use Livewire\Volt\Component;

    new class extends Component
    {
        public string $jobTitle = '';
        public string $description = '';
        public int $minSalary = 0;
        public int $maxSalary = 0;
        public string $mode = '';
        public string $workingHours = '';
        public string $currency = '';
        public $companyIdRequest;
        public int $country_id = 0;
        public string $expiresAt = '';
    }
?>

<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 transition-colors">
    @if (session()->has('mensaje'))
        <div class="bg-green-500 text-white p-3 mb-6 rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('mensaje') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Crear Nueva Oferta de Trabajo</h2>

    <form wire:submit.prevent="submit()" class="space-y-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Título del Puesto:</label>
                <input type="text" wire:model="jobTitle" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                @error('jobTitle') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">País:</label>
                <select wire:model="country_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                    <option value="">Selecciona un país</option>
                    @foreach($countries as $id => $country)
                        <option value="{{ $id }}">{{ $country }}</option>
                    @endforeach
                </select>
                @error('country_id') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Descripción:</label>
            <textarea wire:model="description" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition"></textarea>
            @error('description') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Salario Mínimo:</label>
                <div class="relative">
                    <input type="number" wire:model="minSalary" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                </div>
                @error('minSalary') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Salario Máximo:</label>
                <input type="number" wire:model="maxSalary" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                @error('maxSalary') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Moneda:</label>
                <input type="text" wire:model="currency" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                @error('currency') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Modo de trabajo:</label>
                <input type="text" wire:model="mode" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                @error('mode') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Horas de Trabajo:</label>
                <select wire:model="workingHours" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                    <option value="">Selecciona una opción</option>
                    <option value="full-time">Tiempo Completo</option>
                    <option value="part-time">Medio Tiempo</option>
                    <option value="remote">Remoto</option>
                </select>
                @error('workingHours') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Fecha de expiración:</label>
                <input type="date" wire:model="expiresAt" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                @error('expiresAt') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Etiquetas relacionadas:</label>
                <div class="flex items-center space-x-2">
                    <select wire:model="selectedTag" class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition">
                        <option value="">Selecciona etiquetas relacionadas</option>
                        @foreach($tags as $id => $tag)
                            <option value="{{ $id }}">{{ $tag }}</option>
                        @endforeach
                    </select>
                    <button type="button" wire:click="addTag" class="px-4 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @error('offerTags') <span class="text-red-500 dark:text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                
                <!-- Display selected tags -->
                @if(count($offerTags) > 0)
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach($offerTags as $index => $tagId)
                            <div class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full px-3 py-1 text-sm flex items-center">
                                {{ $tags[$tagId] }}
                                <button type="button" wire:click="removeTag({{ $index }})" class="ml-2 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit()" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium px-6 py-3 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Crear Oferta
            </button>
        </div>
    </form>
</div>
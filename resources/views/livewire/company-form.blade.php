<div class="max-w-3xl mx-auto">
    <div class="px-4 py-8 sm:px-6 lg:px-8 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-2xl font-medium leading-6 text-gray-900 dark:text-white">Crea una nueva compañia</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Por favor rellena los campos con la información requerida</p>
    </div>

    <form wire:submit.prevent="submit" class="px-4 py-5 sm:p-6 dark:bg-gray-800">
        @if (session()->has('message'))
            <div class="mb-4 rounded-md bg-green-50 dark:bg-green-900 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            <div class="sm:col-span-2 grid grid-cols-1 place-items-center gap-1 w-full">
                <div x-data="{ preview: null }" class="relative w-24 h-24 rounded-md overflow-hidden shadow-sm border-2 border-gray-200 dark:border-gray-600">
                    <input wire:model="logo" id="logo" accept="image/*" type="file" class="absolute inset-0 w-full h-full z-10 opacity-0 cursor-pointer"
                        @change="let file = $event.target.files[0];
                                 if (file) {
                                     let reader = new FileReader();
                                     reader.onload = e => preview = e.target.result;
                                     reader.readAsDataURL(file);
                                 }">
                    
                    <!-- Imagen de fondo cuando no hay preview -->
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-md"
                        x-show="!preview">
                        <span class="text-gray-500 dark:text-white text-center text-xs">Subir Imagen</span>
                    </div>
                
                    <!-- Imagen previa -->
                    <img :src="preview" class="absolute inset-0 object-cover w-full h-full rounded-md" x-show="preview">
                </div>
                @error('logo') 
                    <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> 
                @enderror
            </div>
            
            <!-- Company Name -->
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre</label>
                <div class="mt-1">
                    <input type="text" wire:model="name" id="name" class="py-1.5 px-2 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                @error('name') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address -->
            <div class="sm:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Dirección</label>
                <div class="mt-1">
                    <input type="text" wire:model="address" id="address" class="py-1.5 px-2 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                @error('address') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Correo Electronico</label>
                <div class="mt-1">
                    <input type="email" wire:model="email" id="email" class="py-1.5 px-2 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                @error('email') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Website -->
            <div>
                <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Sitio web</label>
                <div class="mt-1">
                    <input type="text" wire:model="website" id="website" class="py-1.5 px-2 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                @error('website') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <!-- Country -->
            <div class="sm:col-span-2">
                <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">País</label>
                <div class="mt-1">
                    <select wire:model="country_id" id="country_id" class="py-1.5 px-2 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Selecciona un país</option>
                        @foreach($countries as $id => $country)
                            <option value="{{ $id }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                @error('country_id') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <!-- Description -->
            <div class="sm:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Descripción</label>
                <div class="mt-1">
                    <textarea wire:model="description" id="description" rows="4" class="py-1.5 px-2 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                </div>
                @error('description') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <a href="/" wire:navigate type="button" class="bg-white dark:bg-gray-700 py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                Cancelar
            </a>
            <button type="submit" class="cursor-pointer ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 dark:focus:ring-offset-gray-800">
                Crear compañia
            </button>
        </div>
    </form>
</div>

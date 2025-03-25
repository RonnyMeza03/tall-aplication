<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 dark:bg-gray-700">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Create New Company</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Please fill in all the required information</p>
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
                <!-- Company Name -->
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Company Name</label>
                    <div class="mt-1">
                        <input type="text" wire:model="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    @error('name') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Description -->
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                    <div class="mt-1">
                        <textarea wire:model="description" id="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>
                    @error('description') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Address -->
                <div class="sm:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
                    <div class="mt-1">
                        <input type="text" wire:model="address" id="address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    @error('address') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                    <div class="mt-1">
                        <input type="email" wire:model="email" id="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    @error('email') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Website -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Website</label>
                    <div class="mt-1">
                        <input type="text" wire:model="website" id="website" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    @error('website') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Logo -->
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Logo URL</label>
                    <div class="mt-1">
                        <input type="text" wire:model="logo" id="logo" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    @error('logo') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Country -->
                <div>
                    <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Country</label>
                    <div class="mt-1">
                        <select wire:model="country_id" id="country_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Select a country</option>
                            @foreach($countries as $id => $country)
                                <option value="{{ $id }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('country_id') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="mt-6 flex justify-end">
                <button type="button" class="bg-white dark:bg-gray-700 py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Cancel
                </button>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Create Company
                </button>
            </div>
        </form>
    </div>
</div>

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
        public int $companyId = 0;
        public int $countryId = 0;
        public string $expiresAt = '';

            // Define el layout específicamente
        public function layout()
        {
            return 'layouts.app'; // Apunta al archivo que ya tienes creado
        }

        /**
         * Mount the component.
         */
        public function mount(): void
        {
            $this->companyId = Auth::user()->company->id;
        }
    }

?>
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    @if (session()->has('mensaje'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('mensaje') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <div class="mb-4">
            <label class="block text-gray-700">Título:</label>
            <input type="text" wire:model="jobTitle" class="w-full border rounded p-2">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descripción:</label>
            <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Salario Minimo:</label>
            <input type="number" wire:model="minSalary" class="w-full border rounded p-2">
            @error('minSalary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Salario Maximo:</label>
            <input type="number" wire:model="maxSalary" class="w-full border rounded p-2">
            @error('maxSalary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Modo de trabajo:</label>
            <input type="text" wire:model="mode" class="w-full border rounded p-2">
            @error('mode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Horas de Trabajo:</label>
            
            <select wire:model="workingHours" class="w-full border rounded p-2">
                <option value="">Selecciona una opción</option>
                <option value="full-time">Tiempo Completo</option>
                <option value="part-time">Medio Tiempo</option>
                <option value="freelance">Freelance</option>
            </select>
            @error('workingHours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Moneda:</label>
            <input type="text" wire:model="currency" class="w-full border rounded p-2">
            @error('currency') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">País:</label>
            <select wire:model="countryId" class="w-full border rounded p-2">
                <option value="">Selecciona un país</option>
                @foreach($countryList as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('countryId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Fecha de expiración:</label>
            <input type="date" wire:model="expiresAt" class="w-full border rounded p-2">
            @error('expiresAt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Crear Oferta
        </button>
    </form>
</div>


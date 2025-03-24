<?php

use App\Models\JobOffer;
use App\Models\UserApply;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;
    
    public $jobOffers = [];
    public $selectedJobId = null;
    public $selectedJob = null;
    public $showModal = false;
    
    // Application form fields
    public $presentation = '';
    public $userUrl = '';
    public $pathFile = '';
    public $nameFile = '';
    public $curriculumPdf = null;
    public $coverLetter = '';
    public $resume = null;
    public $user_id;
    
    // Form validation rules
    protected function rules()
    {
        return [
            'presentation' => 'required|string|min:3|max:100',
            'userUrl' => 'nullable',
            // 'curriculumPdf' => 'required|string|max:20',
        ];
    }
    
    public function loadJobDetails($jobOfferId)
    {
        $this->selectedJobId = $jobOfferId;
        $this->selectedJob = JobOffer::with(['company', 'country'])->find($jobOfferId);
    }
    
    public function mount()
    {
        $this->jobOffers = JobOffer::with(['company', 'country'])->get();
        // Optionally select the first job by default
        if($this->jobOffers->isNotEmpty()) {
            $this->loadJobDetails($this->jobOffers->first()->id);
        }
    }
    
    public function openModal()
    {
        if (auth()->check())
        {
            $this->resetForm();
            $this->showModal = true;
        } else {
            return redirect()->route('login');
        }
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
    
    public function resetForm()
    {
        $this->reset(['presentation', 'userUrl', 'curriculumPdf']);
        $this->resetErrorBag();
    }
    
    public function submitApplication($jobId)
    {
        $user_id = auth()->id();
        // $this->validate();

        $resumePath = $this->resume->store('resumes', 'public');

         // Create a new job application
         UserApply::create([
                'presentation' => $this->presentation,
                'userUrl' => $this->userUrl,
                'nameFile' => $this->resume->getClientOriginalName(),
                'pathFile' => $resumePath,
                'user_id' => $user_id,
                'job_offer_id' => $jobId,
            ]);
            
            $this->closeModal();
            
            // Show success message
            session()->flash('message', '¡Tu solicitud ha sido enviada con éxito!');
        
        try {
            // Store the resume file
            // $resumePath = $this->resume->store('resumes', 'public');
        
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al guardar el archivo. Por favor intenta de nuevo.');
        }
    }
}

?>

<div>
    <!-- Main Content Area with Split View -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Side - Job Listings -->
            <div class="w-full lg:w-2/5 bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                        Principales empleos que te recomendamos
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        En función de tu perfil, preferencias y actividad como solicitudes, búsquedas y contenido guardado.
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ count($jobOffers) }} resultados 
                    </p>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($jobOffers as $index => $jobOffer)
                        <div wire:key="job-{{ $jobOffer->id }}" 
                             class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer
                             @if($selectedJobId == $jobOffer->id) bg-blue-50 dark:bg-blue-900 border-l-4 border-blue-500 @endif"
                             wire:click="loadJobDetails({{ $jobOffer->id }})">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    @if($jobOffer->company && $jobOffer->company->logo)
                                        <img src="{{ $jobOffer->company->logo }}" alt="{{ $jobOffer->company->name }}" class="h-12 w-12 object-cover rounded">
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
                                @if($selectedJobId != $jobOffer->id)
                                    <button class="ml-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Side - Job Details -->
            <div class="w-full lg:w-3/5">
                @if($selectedJob)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                        <!-- Job Header -->
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $selectedJob->jobTitle }}</h1>
                                    <div class="mt-2">
                                        @if($selectedJob->company)
                                            <p class="text-lg text-gray-700 dark:text-gray-300">{{ $selectedJob->company->name }}</p>
                                        @endif
                                        <p class="text-gray-600 dark:text-gray-400">
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
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mt-6 flex flex-wrap gap-2">
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A10.5 10.5 0 0112 4.5 10.5 10.5 0 012.95 13.255a1 1 0 00-.895.553 1 1 0 00.895 1.447A10.5 10.5 0 0112 19.5a10.5 10.5 0 019.05-4.245 1 1 0 00.895-1.447 1 1 0 00-.895-.553z" />
                                    </svg>
                                    @if($selectedJob->jobType)
                                        <span>{{ $selectedJob->mode }}</span>
                                    @else
                                        <span>Tiempo completo</span>
                                    @endif
                                </div>
                                
                                @if($selectedJob->minSalary)
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $selectedJob->minSalary }} @if($selectedJob->maxSalary) - {{ $selectedJob->maxSalary }} @endif</span>
                                    </div>
                                @endif

                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>
                                        @if($selectedJob->country)
                                            {{ $selectedJob->country->name }}
                                        @else
                                            Ubicación no especificada
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <button wire:click="openModal" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Postularse
                                </button>
                                <button class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Guardar
                                </button>
                            </div>
                        </div>
                        
                        <!-- Job Details -->
                        <div class="p-6">
                            <div class="prose dark:prose-invert max-w-none">
                                <h2 class="text-xl font-semibold mb-4 dark:text-white">Descripción del empleo</h2>
                                <div class="text-gray-700 dark:text-gray-300">
                                    @if($selectedJob->description)
                                        {!! nl2br(e($selectedJob->description)) !!}
                                    @else
                                        <p>No hay descripción disponible para este empleo.</p>
                                    @endif
                                </div>
                                
                                @if($selectedJob->requirements)
                                    <h2 class="text-xl font-semibold mt-8 mb-4">Requisitos</h2>
                                    <div class="text-gray-700 dark:text-gray-300">
                                        {!! nl2br(e($selectedJob->requirements)) !!}
                                    </div>
                                @endif
                                
                                @if($selectedJob->benefits)
                                    <h2 class="text-xl font-semibold mt-8 mb-4">Beneficios</h2>
                                    <div class="text-gray-700 dark:text-gray-300">
                                        {!! nl2br(e($selectedJob->benefits)) !!}
                                    </div>
                                @endif
                                
                                <h2 class="text-xl font-semibold mt-8 mb-4 dark:text-white">Acerca de la empresa</h2>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-4">
                                        @if($selectedJob->company && $selectedJob->company->logo)
                                            <img src="{{ $selectedJob->company->logo }}" alt="{{ $selectedJob->company->name }}" class="h-16 w-16 object-cover rounded">
                                        @else
                                            <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        @if($selectedJob->company)
                                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $selectedJob->company->name }}</h3>
                                            <p class="text-gray-600 dark:text-gray-400">{{ $selectedJob->company->description ?? 'Sin descripción disponible' }}</p>
                                        @else
                                            <p class="text-gray-600 dark:text-gray-400">Información de la empresa no disponible</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-4 text-gray-600 dark:text-gray-400">Selecciona una oferta de trabajo para ver los detalles</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Application Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>
                
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
                                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Enviar solicitud
                                        </button>
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
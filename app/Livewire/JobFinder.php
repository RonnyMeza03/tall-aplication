<?php

namespace App\Livewire;

use App\Models\JobOffer;
use App\Models\UserApply;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class JobFinder extends Component
{
    use WithFileUploads;

    public $jobOffers = [];
    public $selectedJobId = null;
    public $selectedJob = null;
    public $showModal = false;
    public $currentPage = 1;
    public $perPage = 10;
    public $totalPages = 0;
    
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
        $this->loadJobs();
    }

    public function loadJobs()
    {
        $jobs = JobOffer::where('isActive', true)
            ->with(['company', 'country'])
            ->paginate($this->perPage, ['*'], 'page', $this->currentPage);
        
        $this->jobOffers = $jobs->items();
        $this->totalPages = $jobs->lastPage();
        
        // Optionally select the first job by default
        if(count($this->jobOffers) > 0 && is_null($this->selectedJobId)) {
            $this->loadJobDetails($this->jobOffers[0]->id);
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->loadJobs();
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->loadJobs();
        }
    }

    public function goToPage($page)
    {
        if ($page >= 1 && $page <= $this->totalPages) {
            $this->currentPage = $page;
            $this->loadJobs();
        }
    }

    public function openModal()
    {
        if (Auth::user())
        {
            $this->resume = null;
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

        $resumePath = $this->resume->storeAs('resumes', $this->resume->getClientOriginalName(), 'public');

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

            // Reset the form fields
            $this->resetForm();
            
            // Show success message
            session()->flash('message', '¡Tu solicitud ha sido enviada con éxito!');
        
        try {
            // Store the resume file
            // $resumePath = $this->.resume->store('resumes', 'public');
        
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al guardar el archivo. Por favor intenta de nuevo.');
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $userApplies = UserApply::where('user_id', Auth::id())->get();
        
        return view('livewire.job-finder')->with(['userApplies' => $userApplies]);
    }
}

<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\JobOffer;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Calendar extends Component
{
    public $month;
    public $year;
    public $monthName;
    public $calendarDays = [];
    public $selectedEvent = null;
    public $isEditing = false;

    public function mount()
    {
        $this->setCurrentMonth();
    }

    public function setCurrentMonth()
    {
        $today = Carbon::today();
        $this->month = $today->month;
        $this->year = $today->year;
        $this->refreshCalendar();
    }

    public function previousMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->month = $date->month;
        $this->year = $date->year;
        $this->refreshCalendar();
    }

    public function nextMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->month = $date->month;
        $this->year = $date->year;
        $this->refreshCalendar();
    }

    public function currentMonth()
    {
        $this->setCurrentMonth();
    }

    private function refreshCalendar()
    {
        $this->calendarDays = [];
        $this->monthName = Carbon::createFromDate($this->year, $this->month, 1)->translatedFormat('F');
        
        // Obtener el primer día del mes
        $firstDay = Carbon::createFromDate($this->year, $this->month, 1);
        
        // Ajustar para que la semana empiece en lunes (1) en lugar de domingo (0)
        $startOfWeek = $firstDay->copy()->startOfWeek(Carbon::MONDAY);
        
        // Obtener el último día del mes
        $lastDay = $firstDay->copy()->endOfMonth();
        
        // Ajustar para que termine en el domingo de la semana del último día
        $endOfWeek = $lastDay->copy()->endOfWeek(Carbon::SUNDAY);
        
        $today = Carbon::today();
        
        // Generar el array con los días del calendario
        for ($day = $startOfWeek; $day->lte($endOfWeek); $day->addDay()) {
            $events = $this->getEventsForDate($day->format('Y-m-d'));
            
            $this->calendarDays[] = [
                'date' => $day->format('Y-m-d'),
                'isCurrentMonth' => $day->month === (int) $this->month,
                'isToday' => $day->isSameDay($today),
                'events' => $events
            ];
        }
    }

    private function getEventsForDate($date)
    {
        $allEvents = [];

        $userCompanies = Auth::user()->company;

        foreach($userCompanies as $company) {
            $allEvents = array_merge($allEvents, $company->jobOffers->map(function($jobOffer) use ($company) {
                // Convert expires_at to a Carbon instance if it's a string
                $expiresAt = $jobOffer->expires_at instanceof Carbon
                    ? $jobOffer->expires_at
                    : Carbon::parse($jobOffer->expires_at);
                    
                return [
                    'id' => $jobOffer->id,
                    'isActive' => $jobOffer->isActive,
                    'jobTitle' => $jobOffer->jobTitle,
                    'dateExp' => $expiresAt->format('Y-m-d'),
                    'company' => $company->name,
                    'description' => $jobOffer->description,
                    'location' => $jobOffer->country->name,
                    'country_id' => $jobOffer->country_id,
                    'mode' => $jobOffer->mode,
                    'workingHours' => $jobOffer->workingHours,
                    'currency' => $jobOffer->currency,
                    'minSalary' => $jobOffer->minSalary,
                    'maxSalary' => $jobOffer->maxSalary,
                    'company_id' => $company->name,
                    'color' => $jobOffer->isActive ? '#4CAF50' : '#FF5722',
                    'textColor' => $jobOffer->isActive ? '#FFFFFF' : '#000000',
                ];
            })->toArray());
        }
        
        // Filter events for the specified date
        return array_filter($allEvents, function($event) use ($date) {
            return $event['dateExp'] === $date;
        });
    }

    public function showEvent($eventId)
    {
        // Buscar el evento por su ID
        $allEvents = [];
        foreach ($this->calendarDays as $day) {
            $allEvents = array_merge($allEvents, $day['events']);
        }
        
        $event = collect($allEvents)->firstWhere('id', $eventId);
        $this->selectedEvent = $event;
    }

    public function closeEventModal()
    {
        $this->selectedEvent = null;
    }

    public function editEvent($eventId)
    {
        $this->toggleEditMode();
    }

    public function deleteEvent($eventId)
    {
        JobOffer::destroy($eventId);
        // Refresh calendar data
        $this->refreshCalendar();

        // Reset selected event
        $this->selectedEvent = null;
        
        // Show success message
        session()->flash('message', 'Evento eliminado exitosamente');
        // Close the modal

        $this->closeEventModal();
    }

    public function toggleEditMode()
    {
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        // Reload the original event data to discard changes
        $this->showEvent($this->selectedEvent['id']);
    }

    public function saveEvent()
    {
        $this->validate([
            'selectedEvent.jobTitle' => 'required',
            'selectedEvent.dateExp' => 'required|date',
            'selectedEvent.country_id' => 'required',
            'selectedEvent.workingHours' => 'required',
            'selectedEvent.currency' => 'required',
            'selectedEvent.minSalary' => 'required|numeric',
            'selectedEvent.maxSalary' => 'required|numeric|gte:selectedEvent.minSalary',
            'selectedEvent.description' => 'required',
        ]);
        
        // Update the event in the database
        $event = JobOffer::find($this->selectedEvent['id']);
        $event->update([
            'jobTitle' => $this->selectedEvent['jobTitle'],
            'expires_at' => $this->selectedEvent['dateExp'],
            'country_id' => $this->selectedEvent['country_id'],
            'mode' => $this->selectedEvent['mode'],
            'workingHours' => $this->selectedEvent['workingHours'],
            'currency' => $this->selectedEvent['currency'],
            'minSalary' => $this->selectedEvent['minSalary'],
            'maxSalary' => $this->selectedEvent['maxSalary'],
            'description' => $this->selectedEvent['description'],
            'isActive' => $this->selectedEvent['isActive'],
        ]);
        
        // Exit edit mode
        $this->isEditing = false;
        
        // Refresh calendar data
        $this->refreshCalendar();

        // Reset selected event
        $this->selectedEvent = null;
        
        // Show success message
        session()->flash('message', 'Evento actualizado exitosamente');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $countries = Country::all()->pluck('name', 'id')->sort();
        return view('livewire.calendar')->with(['countries' => $countries]);
    }
}

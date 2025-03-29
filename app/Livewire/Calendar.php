<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

class Calendar extends Component
{
    public $month;
    public $year;
    public $monthName;
    public $calendarDays = [];
    public $selectedEvent = null;

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
        // Aquí deberías recuperar los eventos de la base de datos
        // Este es un ejemplo con datos ficticios
        $allEvents = [
            [
                'id' => 1,
                'title' => 'Reunión de equipo',
                'date' => '2025-03-15',
                'time' => '10:00',
                'description' => 'Revisión semanal de proyectos',
                'color' => '#4CAF50',
                'textColor' => '#FFFFFF'
            ],
            [
                'id' => 2,
                'title' => 'Entrevista',
                'date' => '2025-03-20',
                'time' => '14:30',
                'description' => 'Entrevista con candidato para el puesto de developer',
                'color' => '#2196F3',
                'textColor' => '#FFFFFF'
            ],
            // Añade más eventos según necesites
        ];
        
        return array_filter($allEvents, function($event) use ($date) {
            return $event['date'] === $date;
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
        // Implementar lógica para editar eventos
    }

    public function deleteEvent($eventId)
    {
        // Implementar lógica para eliminar eventos
        $this->closeEventModal();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.calendar');
    }
}

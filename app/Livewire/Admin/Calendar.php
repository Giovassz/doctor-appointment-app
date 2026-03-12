<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;

class Calendar extends Component
{
    public $year;
    public $month;
    public $doctorId = null;

    public function mount()
    {
        $now = Carbon::now();
        $this->year = $now->year;
        $this->month = $now->month;
    }

    public function nextMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function prevMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function goToToday()
    {
        $now = Carbon::now();
        $this->year = $now->year;
        $this->month = $now->month;
    }

    public function render()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1);
        $monthName = $date->translatedFormat('F Y');
        
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();
        
        // Calculate days to show (including padding from prev/next month)
        $startOfGrid = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfGrid = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);
        
        $appointments = Appointment::with(['patient', 'doctor.user'])
            ->whereBetween('date', [$startOfGrid->format('Y-m-d'), $endOfGrid->format('Y-m-d')])
            ->whereIn('status', [1, 2]) // Programada, Completada
            ->when($this->doctorId, function($query) {
                return $query->where('doctor_id', $this->doctorId);
            })
            ->get();

        $doctors = Doctor::with('user:id,name')->get()->map(fn($d) => [
            'id' => $d->id,
            'name' => $d->user->name
        ]);

        $grid = [];
        $current = $startOfGrid->copy();
        
        while ($current <= $endOfGrid) {
            $dayDate = $current->format('Y-m-d');
            $grid[] = [
                'date' => $dayDate,
                'day' => $current->day,
                'isCurrentMonth' => $current->month == $this->month,
                'isToday' => $current->isToday(),
                'appointments' => $appointments->where('date', $dayDate)
            ];
            $current->addDay();
        }

        return view('livewire.admin.calendar', [
            'monthName' => $monthName,
            'grid' => $grid,
            'doctors' => $doctors
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
                ['name' => 'Calendario']
            ]
        ]);
    }
}

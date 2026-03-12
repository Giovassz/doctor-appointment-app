<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Appointment;

class AppointmentIndex extends Component
{
    public function render()
    {
        $appointments = Appointment::with(['patient', 'doctor.user'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('livewire.admin.appointment-index', compact('appointments'));
    }
}

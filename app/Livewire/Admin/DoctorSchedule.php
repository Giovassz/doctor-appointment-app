<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Doctor;

class DoctorSchedule extends Component
{
    public Doctor $doctor;

    public function mount(Doctor $doctor)
    {
        $this->doctor = $doctor->load('user');
    }

    public function render()
    {
        return view('livewire.admin.doctor-schedule')->layout('layouts.admin');
    }
}

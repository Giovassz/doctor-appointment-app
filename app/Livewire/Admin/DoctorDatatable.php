<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Doctor;

class DoctorDatatable extends Component
{
    public function render()
    {
        return view('livewire.admin.doctor-datatable', [
            'doctors' => Doctor::with(['user', 'speciality'])->paginate(10)
        ]);
    }
}

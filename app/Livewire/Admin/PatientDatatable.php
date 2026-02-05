<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PatientDatatable extends Component
{
    public function render()
    {
        return view('livewire.admin.patient-datatable', [
            'patients' => \App\Models\Patient::with('bloodType')->paginate(10)
        ]);
    }
}

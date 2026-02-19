<?php

namespace App\Livewire\Doctors;

use App\Models\Doctor;
use App\Models\Speciality;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class EditDoctor extends Component
{
    use WireUiActions;

    public Doctor $doctor;
    public $specialities = [];

    public $speciality_id;
    public $medical_license_number;
    public $biography;

    public function mount(Doctor $doctor)
    {
        $this->doctor = $doctor;

        $this->specialities = Speciality::pluck('name', 'id')->toArray();

        $this->speciality_id = $doctor->speciality_id;
        $this->medical_license_number = $doctor->medical_license_number;
        $this->biography = $doctor->biography;
    }

    protected function rules()
    {
        return [
            'speciality_id' => 'nullable|exists:specialities,id',
            'medical_license_number' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        $this->doctor->update([
            'speciality_id' => $this->speciality_id,
            'medical_license_number' => $this->medical_license_number,
            'biography' => $this->biography,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Doctor actualizado',
            'text' => 'La información se guardó correctamente.'
        ]);

        return redirect()->route('admin.doctors.index');
    }

    public function render()
    {
        return view('livewire.doctors.edit-doctor');
    }
}

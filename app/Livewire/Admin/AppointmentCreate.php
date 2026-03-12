<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use WireUi\Traits\WireUiActions;

class AppointmentCreate extends Component
{
    use WireUiActions;

    public $patient_id;
    public $doctor_id;
    public $date;
    public $start_time;
    public $end_time;
    public $reason;

    protected function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'reason' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        Appointment::create([
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'reason' => $this->reason,
            'status' => 1, // Programada
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'La cita ha sido registrada correctamente.',
        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        // Optimization: Prepare flat arrays for WireUI Select to ensure reliable binding and better performance
        $patients = Patient::select('id', 'first_name', 'last_name', 'email')
            ->orderBy('first_name')
            ->limit(50)
            ->get()
            ->map(fn($p) => [
                'id' => $p->id,
                'name' => "{$p->first_name} {$p->last_name}",
                'email' => $p->email
            ]);

        $doctors = Doctor::with(['user:id,name', 'speciality:id,name'])
            ->limit(20)
            ->get()
            ->map(fn($d) => [
                'id' => $d->id,
                'name' => $d->user->name,
                'speciality' => $d->speciality->name ?? 'Sin especialidad'
            ]);
            
        return view('livewire.admin.appointment-create', compact('patients', 'doctors'));
    }
}

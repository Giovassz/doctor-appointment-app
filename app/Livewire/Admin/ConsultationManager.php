<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Appointment;
use WireUi\Traits\WireUiActions;

class ConsultationManager extends Component
{
    use WireUiActions;

    public Appointment $appointment;
    public $diagnosis;
    public $treatment;
    public $notes;
    public $prescription = []; // Array of {medication, dose, frequency}
    
    public $showHistoryModal = false;
    public $pastConsultations = [];

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment->load(['patient', 'doctor.user']);
        $this->diagnosis = $appointment->diagnosis;
        $this->treatment = $appointment->treatment;
        $this->notes = $appointment->notes;
        $this->prescription = $appointment->prescription ?? [['medication' => '', 'dose' => '', 'frequency' => '']];
    }

    public function addMedication()
    {
        $this->prescription[] = ['medication' => '', 'dose' => '', 'frequency' => ''];
    }

    public function removeMedication($index)
    {
        unset($this->prescription[$index]);
        $this->prescription = array_values($this->prescription);
    }

    public function openHistory()
    {
        $this->pastConsultations = Appointment::where('patient_id', $this->appointment->patient_id)
            ->where('id', '!=', $this->appointment->id)
            ->whereNotNull('diagnosis')
            ->with('doctor.user:id,name')
            ->select(['id', 'date', 'diagnosis', 'treatment', 'doctor_id'])
            ->orderBy('date', 'desc')
            ->get();
        
        $this->showHistoryModal = true;
    }

    public function save()
    {
        $this->validate([
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'prescription.*.medication' => 'required|string',
        ]);

        $this->appointment->update([
            'diagnosis' => $this->diagnosis,
            'treatment' => $this->treatment,
            'notes' => $this->notes,
            'prescription' => $this->prescription,
            'status' => 2, // Completada
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'La consulta ha sido guardada correctamente.',
        ]);
        
        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        return view('livewire.admin.consultation-manager')->layout('layouts.admin');
    }
}

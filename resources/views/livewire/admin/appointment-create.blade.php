<div>
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Paciente --}}
            <x-wire-select
                label="Seleccionar Paciente"
                placeholder="Busca un paciente"
                wire:model="patient_id"
                :options="$patients"
                option-label="name"
                option-description="email"
                option-value="id"
            />

            {{-- Doctor --}}
            <x-wire-select
                label="Seleccionar Doctor"
                placeholder="Busca un doctor"
                wire:model="doctor_id"
                :options="$doctors"
                option-label="name"
                option-description="speciality"
                option-value="id"
            />

            {{-- Fecha --}}
            <x-wire-input
                type="date"
                label="Fecha de la Cita"
                wire:model="date"
                min="{{ date('Y-m-d') }}"
            />

            {{-- Duración (opcional, por defecto 15) --}}
            <x-wire-input
                type="number"
                label="Duración (minutos)"
                wire:model="duration"
                placeholder="15"
            />

            {{-- Hora Inicio --}}
            <x-wire-input
                type="time"
                label="Hora de Inicio"
                wire:model="start_time"
            />

            {{-- Hora Fin --}}
            <x-wire-input
                type="time"
                label="Hora de Fin"
                wire:model="end_time"
            />
        </div>

        {{-- Motivo --}}
        <div>
            <x-wire-textarea
                label="Motivo de la Cita"
                placeholder="Describe el motivo de la consulta..."
                wire:model="reason"
            />
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.appointments.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancelar
            </a>
            <x-wire-button type="submit" primary label="Registrar Cita" spinner="save" />
        </div>
    </form>
</div>

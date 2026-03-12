<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</h2>
                    <p class="text-sm text-gray-500">Cita con: {{ $appointment->doctor->user->name }} | Fecha: {{ $appointment->date->format('d/m/Y') }}</p>
                </div>
                <div class="flex space-x-2">
                    <x-wire-button icon="user" secondary outline label="Ver Historia" href="{{ route('admin.patients.index') }}" />
                    <x-wire-button icon="clock" primary outline label="Consultas Anteriores" wire:click="openHistory" />
                </div>
            </div>

            <div x-data="{ activeTab: 'consulta' }">
                {{-- Pestañas --}}
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button @click="activeTab = 'consulta'" 
                            :class="activeTab === 'consulta' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Consulta
                        </button>
                        <button @click="activeTab = 'receta'" 
                            :class="activeTab === 'receta' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Receta
                        </button>
                    </nav>
                </div>

                {{-- Contenido Pestaña Consulta --}}
                <div x-show="activeTab === 'consulta'" class="space-y-6">
                    <x-wire-textarea label="Diagnóstico" placeholder="Describe el diagnóstico del paciente..." wire:model.defer="diagnosis" rows="4" />
                    <x-wire-textarea label="Tratamiento" placeholder="Describe el tratamiento recomendado..." wire:model.defer="treatment" rows="4" />
                    <x-wire-textarea label="Notas" placeholder="Agregue notas adicionales sobre la consulta..." wire:model.defer="notes" rows="2" />
                </div>

                {{-- Contenido Pestaña Receta --}}
                <div x-show="activeTab === 'receta'" class="space-y-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-medium text-gray-900">Medicamentos</h3>
                        <x-wire-button icon="plus" sm primary label="Añadir Medicamento" wire:click="addMedication" />
                    </div>

                    @foreach($prescription as $index => $item)
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end p-4 bg-gray-50 rounded-lg relative">
                            <div class="md:col-span-2">
                                <x-wire-input label="Medicamento" placeholder="Ej: Amoxicilina 500mg" wire:model.defer="prescription.{{ $index }}.medication" />
                            </div>
                            <div>
                                <x-wire-input label="Dosis" placeholder="Ej: 1 cada 8 horas" wire:model.defer="prescription.{{ $index }}.dose" />
                            </div>
                            <div class="flex items-end space-x-2">
                                <x-wire-input label="Frecuencia/Duración" placeholder="Ej: por 7 días" wire:model.defer="prescription.{{ $index }}.frequency" class="w-full" />
                                <x-wire-button circle icon="trash" negative outline sm wire:click="removeMedication({{ $index }})" />
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.appointments.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </a>
                    <x-wire-button primary label="Guardar Consulta" wire:click="save" spinner="save" icon="save" />
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Consultas Anteriores --}}
    <x-wire-modal wire:model.defer="showHistoryModal" max-width="4xl">
        <x-card title="Historial Clínico - {{ $appointment->patient->first_name }}">
            <div class="space-y-6 overflow-y-auto max-h-[60vh]">
                @forelse($pastConsultations as $past)
                    <div class="border-l-4 border-blue-500 pl-4 py-2 bg-gray-50 rounded-r-lg">
                        <div class="flex justify-between items-start">
                            <span class="font-bold text-gray-800">{{ $past->date->format('d/m/Y') }}</span>
                            <span class="text-xs text-gray-500 italic">Atendido por: {{ $past->doctor->user->name }}</span>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm"><strong>Diagnóstico:</strong> {{ $past->diagnosis }}</p>
                            <p class="text-sm mt-1"><strong>Tratamiento:</strong> {{ $past->treatment }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No hay consultas anteriores registradas para este paciente.</p>
                @endforelse
            </div>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-wire-button flat label="Cerrar" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-wire-modal>
</div>

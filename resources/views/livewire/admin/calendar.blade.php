<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ ucfirst($monthName) }}</h2>
                    <p class="text-sm text-gray-500">Citas programadas y completadas</p>
                </div>
                
                <div class="flex flex-col md:flex-row items-center gap-4">
                    {{-- Doctor Filter --}}
                    <div class="w-64">
                        <x-wire-select
                            placeholder="Todos los doctores"
                            wire:model.live="doctorId"
                            :options="$doctors"
                            option-label="name"
                            option-value="id"
                            icon="user"
                        />
                    </div>

                    <div class="flex space-x-2">
                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <button type="button" wire:click="prevMonth" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button type="button" wire:click="nextMonth" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <button type="button" wire:click="goToToday" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10">
                                Hoy
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                {{-- Headers --}}
                <div class="grid grid-cols-7 bg-gray-50 text-center border-b border-gray-200">
                    @foreach(['dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb'] as $day)
                        <div class="py-2 text-xs font-bold text-gray-500 uppercase">{{ $day }}</div>
                    @endforeach
                </div>

                {{-- Calendar Grid --}}
                <div class="grid grid-cols-7 border-l border-t border-gray-100">
                    @foreach($grid as $cell)
                        <div class="min-h-[140px] p-2 border-r border-b border-gray-100 {{ !$cell['isCurrentMonth'] ? 'bg-gray-50 opacity-50' : '' }} {{ $cell['isToday'] ? 'bg-blue-50/40' : '' }}">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-sm font-bold {{ $cell['isToday'] ? 'bg-blue-600 text-white w-6 h-6 flex items-center justify-center rounded-full' : 'text-gray-600' }}">
                                    {{ $cell['day'] }}
                                </span>
                            </div>
                            
                            <div class="space-y-1">
                                @foreach($cell['appointments'] as $appt)
                                    <div wire:click="selectAppointment({{ $appt->id }})" 
                                        class="text-[10px] p-1.5 rounded-md cursor-pointer transition-all hover:scale-105 active:scale-95 border-l-4 shadow-sm
                                        {{ $appt->status == 2 ? 'bg-green-50 text-green-800 border-green-500 hover:bg-green-100' : 'bg-blue-50 text-blue-800 border-blue-500 hover:bg-blue-100' }}">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-black">{{ \Carbon\Carbon::parse($appt->start_time)->format('H:i') }}</span>
                                            @if($appt->status == 2)
                                                <i class="fas fa-check-circle text-[8px]"></i>
                                            @endif
                                        </div>
                                        <div class="truncate font-semibold">{{ $appt->patient->first_name }}</div>
                                        @if(!$doctorId)
                                            <div class="truncate text-[8px] opacity-70 italic">{{ $appt->doctor->user->name }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="mt-6 flex flex-wrap gap-6 text-xs text-gray-500 bg-gray-50 p-4 rounded-lg border border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 bg-blue-500 rounded-md shadow-sm"></span> 
                    <span class="font-medium">Cita Programada</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 bg-green-500 rounded-md shadow-sm"></span> 
                    <span class="font-medium">Cita Completada</span>
                </div>
                <div class="ml-auto italic">
                    * Haz clic en una cita para ver los detalles.
                </div>
            </div>
        </div>
    </div>

    {{-- Appointment Preview Modal --}}
    <x-wire-modal wire:model="showAppointmentModal" max-width="md">
        <x-wire-card title="Detalles de la Cita">
            @if($selectedAppointment)
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-blue-50 p-4 rounded-lg">
                        <x-wire-avatar size="xl" label="{{ substr($selectedAppointment->patient->first_name, 0, 1) }}" />
                        <div>
                            <h3 class="text-lg font-bold text-blue-900">{{ $selectedAppointment->patient->first_name }} {{ $selectedAppointment->patient->last_name }}</h3>
                            <p class="text-sm text-blue-700">{{ $selectedAppointment->patient->email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Fecha</label>
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="far fa-calendar-alt text-blue-500"></i>
                                <span class="text-sm font-semibold">{{ $selectedAppointment->date->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Horario</label>
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="far fa-clock text-blue-500"></i>
                                <span class="text-sm font-semibold">
                                    {{ \Carbon\Carbon::parse($selectedAppointment->start_time)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($selectedAppointment->end_time)->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Doctor Especialista</label>
                        <div class="flex items-center gap-2 text-gray-700">
                            <i class="fas fa-user-md text-blue-600"></i>
                            <span class="text-sm font-semibold">{{ $selectedAppointment->doctor->user->name }}</span>
                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">
                                {{ $selectedAppointment->doctor->speciality->name ?? 'Médico General' }}
                            </span>
                        </div>
                    </div>

                    @if($selectedAppointment->reason)
                        <div class="p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Motivo de Consulta</label>
                            <p class="text-sm text-gray-600 italic">"{{ $selectedAppointment->reason }}"</p>
                        </div>
                    @endif

                    <div class="flex items-center justify-between p-3 rounded-lg {{ $selectedAppointment->status == 2 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        <span class="text-xs font-bold uppercase">Estado de la Cita:</span>
                        <span class="text-sm font-black">{{ $selectedAppointment->status == 2 ? 'COMPLETADA' : 'PROGRAMADA' }}</span>
                    </div>
                </div>
            @endif

            <x-slot name="footer">
                <div class="flex justify-between gap-3">
                    @if($selectedAppointment && $selectedAppointment->status == 1)
                        <x-wire-button primary label="Atender Ahora" icon="heart" href="{{ route('admin.consultations.manage', $selectedAppointment->id ?? 0) }}" />
                    @endif
                    <x-wire-button flat label="Cerrar" x-on:click="close" class="ml-auto" />
                </div>
            </x-slot>
        </x-wire-card>
    </x-wire-modal>
</div>

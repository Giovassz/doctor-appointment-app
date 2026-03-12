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
                        <div class="min-h-[120px] p-2 border-r border-b border-gray-100 {{ !$cell['isCurrentMonth'] ? 'bg-gray-50 opacity-50' : '' }} {{ $cell['isToday'] ? 'bg-blue-50/30' : '' }}">
                            <div class="flex justify-between items-start">
                                <span class="text-sm font-bold {{ $cell['isToday'] ? 'text-blue-600' : 'text-gray-600' }}">
                                    {{ $cell['day'] }}
                                </span>
                            </div>
                            
                            <div class="mt-2 space-y-1">
                                @foreach($cell['appointments'] as $appt)
                                    <div class="text-[10px] p-1 rounded truncate border-l-2 shadow-sm
                                        {{ $appt->status == 2 ? 'bg-green-50 text-green-800 border-green-500' : 'bg-blue-50 text-blue-800 border-blue-500' }}"
                                        title="{{ $appt->patient->first_name }} - {{ $appt->doctor->user->name }}">
                                        <span class="font-bold">{{ \Carbon\Carbon::parse($appt->start_time)->format('H:i') }}</span>
                                        {{ $appt->patient->first_name }}
                                        <div class="text-[8px] opacity-75">{{ $appt->doctor->user->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="mt-4 flex gap-4 text-xs text-gray-500">
                <div class="flex items-center gap-1">
                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span> Programado
                </div>
                <div class="flex items-center gap-1">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span> Completado
                </div>
            </div>
        </div>
    </div>
</div>

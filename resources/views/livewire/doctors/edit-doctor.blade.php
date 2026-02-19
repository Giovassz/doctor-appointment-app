<div class="max-w-5xl mx-auto p-4">

    <x-wire-card>
        <x-slot name="header">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center font-bold text-2xl text-blue-600 border border-blue-100 shadow-sm">
                        {{ strtoupper(substr($doctor->user->name, 0, 1) . substr(explode(' ', $doctor->user->name)[1] ?? '', 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            {{ $doctor->user->name }}
                        </h2>
                        <p class="text-sm text-gray-500 font-medium">
                            Licencia: {{ $medical_license_number ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <x-wire-button href="{{ route('admin.doctors.index') }}" white label="Volver" class="px-6 font-medium" />
                    <x-wire-button wire:click="save" primary class="px-8 font-medium">
                        <i class="fa-solid fa-check mr-2"></i>
                        Guardar cambios
                    </x-wire-button>
                </div>
            </div>
        </x-slot>

        {{-- Formulario --}}
        <div class="p-6 grid grid-cols-1 gap-8">

            <x-wire-native-select
                label="Especialidad"
                wire:model="speciality_id"
                placeholder="Seleccione una especialidad"
            >
                <option value="">Seleccione una especialidad</option>
                @foreach($specialities as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </x-wire-native-select>

            <x-wire-input
                label="Número de licencia médica"
                wire:model.live="medical_license_number"
                placeholder="Ingrese la licencia"
                icon="identification"
            />

            <x-wire-textarea
                label="Biografía"
                wire:model="biography"
                placeholder="Escriba una breve biografía..."
                rows="4"
            />

        </div>

    </x-wire-card>

</div>

<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Pacientes',
        'href' => route('admin.patients.index'),
    ],
    [
        'name' => 'Editar Paciente'
    ],
]">
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-wire-card>
                <x-slot name="header">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xl">
                                {{ substr($patient->first_name, 0, 1) }}{{ substr($patient->last_name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <h2 class="text-2xl font-bold text-gray-800">{{ $patient->first_name }} {{ $patient->last_name }}</h2>
                                <p class="text-sm text-gray-500">Expediente: #{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.patients.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </a>
                    </div>
                </x-slot>

                <x-tabs :active="$initialTab">
                    <x-slot name="header">
                        <x-tab-link tab="personal" :error="$errors->hasAny(['first_name', 'last_name', 'email', 'phone'])">
                            <i class="fa-solid fa-user mr-2"></i>
                            Datos Personales
                        </x-tab-link>

                        <x-tab-link tab="medical" :error="$errors->hasAny(['blood_type_id', 'allergies'])">
                            <i class="fa-solid fa-heart-pulse mr-2"></i>
                            Antecedentes
                        </x-tab-link>

                        <x-tab-link tab="general" :error="$errors->has('address')">
                            <i class="fa-solid fa-location-dot mr-2"></i>
                            Información General
                        </x-tab-link>

                        <x-tab-link tab="emergency" :error="$errors->hasAny(['emergency_contact_name', 'emergency_contact_phone'])">
                            <i class="fa-solid fa-phone-flip mr-2"></i>
                            Contacto de Emergencia
                        </x-tab-link>
                    </x-slot>

                    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Tab: Datos Personales -->
                    <x-tab-content tab="personal">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-wire-input label="Nombres" name="first_name" value="{{ old('first_name', $patient->first_name) }}" required />
                            <x-wire-input label="Apellidos" name="last_name" value="{{ old('last_name', $patient->last_name) }}" required />
                            
                            <x-wire-input label="Correo Electrónico" name="email" type="email" icon="envelope" value="{{ old('email', $patient->email) }}" required />
                            
                            <x-wire-maskable 
                                label="Teléfono" 
                                name="phone" 
                                mask="(###) ###-####" 
                                placeholder="(000) 000-0000"
                                icon="phone"
                                value="{{ old('phone', $patient->phone) }}"
                            />
                        </div>
                    </x-tab-content>

                    <!-- Tab: Antecedentes -->
                    <x-tab-content tab="medical">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-wire-native-select
                                label="Tipo de Sangre"
                                placeholder="Seleccione tipo de sangre"
                                name="blood_type_id"
                                value="{{ old('blood_type_id', $patient->blood_type_id) }}"
                            >
                                <option value="">Seleccione tipo de sangre</option>
                                @foreach ($bloodTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('blood_type_id', $patient->blood_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </x-wire-native-select>
                        </div>
                        <x-wire-textarea label="Alergias Conocidas" name="allergies" placeholder="Describa alergias o condiciones preexistentes..." rows="5">{{ old('allergies', $patient->allergies) }}</x-wire-textarea>
                    </x-tab-content>

                    <!-- Tab: Información General -->
                    <x-tab-content tab="general">
                        <x-wire-textarea label="Dirección" name="address" rows="3" placeholder="Dirección completa...">{{ old('address', $patient->address) }}</x-wire-textarea>
                    </x-tab-content>

                    <!-- Tab: Contacto de Emergencia -->
                    <x-tab-content tab="emergency">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-wire-input label="Nombre del Contacto" name="emergency_contact_name" icon="user" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}" />
                            
                            <x-wire-maskable 
                                label="Teléfono de Emergencia" 
                                name="emergency_contact_phone" 
                                mask="(###) ###-####" 
                                placeholder="(000) 000-0000"
                                icon="phone"
                                value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}"
                            />
                        </div>
                    </x-tab-content>
                </x-tabs>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.patients.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                            Cancelar
                        </a>
                        <x-wire-button type="submit" primary label="Guardar Cambios" class="px-8" />
                    </div>
                </form>
            </x-wire-card>
        </div>
    </div>
</x-admin-layout>


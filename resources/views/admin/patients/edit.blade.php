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
    <div class="py-12" x-data="{ 
        tab: '{{ $errors->hasAny(['first_name', 'last_name', 'email', 'phone']) ? 'personal' : ($errors->hasAny(['blood_type_id', 'allergies']) ? 'medical' : ($errors->has('address') ? 'general' : ($errors->hasAny(['emergency_contact_name', 'emergency_contact_phone']) ? 'emergency' : 'personal'))) }}',
        focusError() {
            setTimeout(() => {
                const firstError = document.querySelector('.text-negative-600');
                if (firstError) {
                    const input = firstError.closest('div').querySelector('input, select, textarea');
                    if (input) input.focus();
                }
            }, 100);
        }
    }" x-init="focusError()">
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

                <div class="mb-6 border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
                        <button type="button" 
                            @click="tab = 'personal'"
                            :class="tab === 'personal' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center {{ $errors->hasAny(['first_name', 'last_name', 'email', 'phone']) ? 'text-red-600 border-red-500' : '' }}">
                            <i class="fa-solid fa-user mr-2"></i>
                            Datos Personales
                        </button>

                        <button type="button" 
                            @click="tab = 'medical'"
                            :class="tab === 'medical' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center {{ $errors->hasAny(['blood_type_id', 'allergies']) ? 'text-red-600 border-red-500' : '' }}">
                            <i class="fa-solid fa-heart-pulse mr-2"></i>
                            Antecedentes
                        </button>

                        <button type="button" 
                            @click="tab = 'general'"
                            :class="tab === 'general' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center {{ $errors->has('address') ? 'text-red-600 border-red-500' : '' }}">
                            <i class="fa-solid fa-location-dot mr-2"></i>
                            Información General
                        </button>

                        <button type="button" 
                            @click="tab = 'emergency'"
                            :class="tab === 'emergency' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center {{ $errors->hasAny(['emergency_contact_name', 'emergency_contact_phone']) ? 'text-red-600 border-red-500' : '' }}">
                            <i class="fa-solid fa-phone-flip mr-2"></i>
                            Contacto de Emergencia
                        </button>
                    </nav>
                </div>

                <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-4">
                        <!-- Tab: Datos Personales -->
                        <div x-show="tab === 'personal'" class="space-y-6" x-cloak>
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
                        </div>

                        <!-- Tab: Antecedentes -->
                        <div x-show="tab === 'medical'" class="space-y-6" x-cloak>
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
                        </div>

                        <!-- Tab: Información General -->
                        <div x-show="tab === 'general'" class="space-y-6" x-cloak>
                            <x-wire-textarea label="Dirección" name="address" rows="3" placeholder="Dirección completa...">{{ old('address', $patient->address) }}</x-wire-textarea>
                        </div>

                        <!-- Tab: Contacto de Emergencia -->
                        <div x-show="tab === 'emergency'" class="space-y-6" x-cloak>
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
                        </div>
                    </div>

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


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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <div class="mb-8 border-b border-gray-100 pb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Editar Información del Paciente</h2>
                    <p class="text-gray-600 mt-1">Actualice los datos generales y de salud de <strong>{{ $patient->first_name }} {{ $patient->last_name }}</strong>.</p>
                </div>

                <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Datos Personales -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-blue-600 flex items-center">
                                <i class="fa-solid fa-user mr-2"></i> Datos Personales
                            </h3>
                            
                            <div>
                                <x-label for="first_name" value="Nombres" />
                                <x-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" value="{{ $patient->first_name }}" required />
                                <x-input-error for="first_name" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="last_name" value="Apellidos" />
                                <x-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" value="{{ $patient->last_name }}" required />
                                <x-input-error for="last_name" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="email" value="Correo Electrónico" />
                                <x-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ $patient->email }}" required />
                                <x-input-error for="email" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="phone" value="Teléfono" />
                                <x-input id="phone" name="phone" type="text" class="mt-1 block w-full" value="{{ $patient->phone }}" />
                                <x-input-error for="phone" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="address" value="Dirección" />
                                <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $patient->address }}</textarea>
                                <x-input-error for="address" class="mt-2" />
                            </div>
                        </div>

                        <!-- Datos Médicos -->
                        <div class="space-y-6 bg-blue-50/50 p-6 rounded-xl border border-blue-100">
                            <h3 class="text-lg font-semibold text-blue-700 flex items-center">
                                <i class="fa-solid fa-hospital-user mr-2"></i> Información Médica
                            </h3>

                            <div>
                                <x-label for="blood_type_id" value="Tipo de Sangre" />
                                <select id="blood_type_id" name="blood_type_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Seleccione tipo de sangre</option>
                                    @foreach ($bloodTypes as $type)
                                        <option value="{{ $type->id }}" {{ $patient->blood_type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="blood_type_id" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="allergies" value="Alergias Conocidas" />
                                <textarea id="allergies" name="allergies" rows="5" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Describa alergias o condiciones preexistentes...">{{ $patient->allergies }}</textarea>
                                <x-input-error for="allergies" class="mt-2" />
                            </div>

                            <div class="p-4 bg-white rounded-lg border border-blue-100 italic text-sm text-gray-500">
                                <i class="fa-solid fa-circle-info text-blue-400 mr-2"></i>
                                Esta información es vital para la seguridad del paciente durante las consultas y procedimientos médicos.
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-10 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.patients.index') }}" class="text-gray-600 hover:text-gray-900 mr-6 transition duration-150">
                            Volver al Listado
                        </a>
                        <x-button class="bg-blue-600 hover:bg-blue-700 px-8">
                            Guardar Cambios
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

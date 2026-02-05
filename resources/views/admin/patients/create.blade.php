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
        'name' => 'Nuevo Paciente'
    ],
]">
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Registrar Nuevo Paciente</h2>
                    <p class="text-gray-600">Complete los datos básicos para comenzar.</p>
                </div>

                <form action="{{ route('admin.patients.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-label for="first_name" value="Nombres" />
                            <x-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" required autofocus />
                            <x-input-error for="first_name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="last_name" value="Apellidos" />
                            <x-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" required />
                            <x-input-error for="last_name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="email" value="Correo Electrónico" />
                            <x-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                            <x-input-error for="email" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="phone" value="Teléfono" />
                            <x-input id="phone" name="phone" type="text" class="mt-1 block w-full" />
                            <x-input-error for="phone" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.patients.index') }}" class="text-gray-600 hover:text-gray-900 mr-4 transition duration-150">
                            Cancelar
                        </a>
                        <x-button class="bg-blue-600 hover:bg-blue-700">
                            Crear y Continuar
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

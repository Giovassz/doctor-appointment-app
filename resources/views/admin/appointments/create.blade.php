<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Citas Médicas',
        'href' => route('admin.appointments.index'),
    ],
    [
        'name' => 'Nueva Cita'
    ],
]">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Registrar Nueva Cita</h2>
                </div>

                @livewire('admin.appointment-create')
            </div>
        </div>
    </div>
</x-admin-layout>

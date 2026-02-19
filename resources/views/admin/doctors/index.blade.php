<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Doctores'
    ],
]">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Listado de Doctores</h2>
                    {{-- Assuming we create doctors by assigning roles to users --}}
                </div>

                @livewire('admin.datatables.doctor-table')
            </div>
        </div>
    </div>
</x-admin-layout>

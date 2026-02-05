<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex items-center mb-4">
        <x-application-logo class="block h-12 w-auto mr-4" />
        <h1 class="text-2xl font-medium text-gray-900">
            Bienvenido a Medic
        </h1>
    </div>

    <p class="mt-2 text-gray-500 leading-relaxed">
        Administre sus citas médicas, pacientes y personal de manera eficiente con Medic. Use la barra lateral para navegar a las secciones de gestión de Usuarios y Roles.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Gestión de Usuarios</h2>
        <p class="text-gray-600 text-sm mb-4">Administre cuentas de médicos, personal y pacientes.</p>
        <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Ir a Usuarios &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Roles y Permisos</h2>
        <p class="text-gray-600 text-sm mb-4">Configure niveles de acceso y roles de seguridad.</p>
        <a href="{{ route('admin.roles.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Ir a Roles &rarr;</a>
    </div>
</div>

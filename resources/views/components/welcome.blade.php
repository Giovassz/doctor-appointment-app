<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex items-center mb-4">
        <x-application-logo class="block h-12 w-auto mr-4" />
        <h1 class="text-2xl font-medium text-gray-900">
            Welcome to Medic
        </h1>
    </div>

    <p class="mt-2 text-gray-500 leading-relaxed">
        Manage your medical appointments, patients, and staff efficiently with Medic. Use the sidebar to navigate to the Users and Roles management sections.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Users Management</h2>
        <p class="text-gray-600 text-sm mb-4">Manage doctors, staff, and patient accounts.</p>
        <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Go to Users &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Roles & Permissions</h2>
        <p class="text-gray-600 text-sm mb-4">Configure access levels and security roles.</p>
        <a href="{{ route('roles.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Go to Roles &rarr;</a>
    </div>
</div>

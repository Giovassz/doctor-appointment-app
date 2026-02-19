<div class="hidden md:flex flex-col w-64 bg-gray-900 border-r border-gray-800 min-h-screen">
    <div class="flex items-center justify-center h-16 border-b border-gray-800">
        <span class="text-xl font-bold text-white flex items-center gap-2">
            <img src="{{ asset('images/logoMedic.png') }}" alt="Medic Logo" class="w-8 h-8 object-contain">
            Medic
        </span>
    </div>

    <div class="flex flex-col flex-grow overflow-y-auto">
        <nav class="flex-1 px-2 py-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-lg group transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>

            <div class="pt-4 pb-1 pl-4 text-xs font-semibold text-gray-500 uppercase">
                Gestión
            </div>

            @can('roles.index')
            <a href="{{ route('admin.roles.index') }}" class="flex items-center px-4 py-2 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.roles.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                 <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.roles.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Roles y Permisos
            </a>
            @endcan

            @can('users.index')
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios
            </a>
            @endcan

            @can('patients.index')
            <a href="{{ route('admin.patients.index') }}" class="flex items-center px-4 py-2 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.patients.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <span class="w-5 h-5 mr-3 flex items-center justify-center {{ request()->routeIs('admin.patients.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                    <i class="fa-solid fa-user-injured text-lg"></i>
                </span>
                Pacientes
            </a>
            @endcan

            @can('doctors.index')
            <a href="{{ route('admin.doctors.index') }}" class="flex items-center px-4 py-2 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.doctors.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <span class="w-5 h-5 mr-3 flex items-center justify-center {{ request()->routeIs('admin.doctors.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                    <i class="fa-solid fa-user-md text-lg"></i>
                </span>
                Doctores
            </a>
            @endcan
        </nav>
    </div>
</div>

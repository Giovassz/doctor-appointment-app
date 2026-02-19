<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-gauge w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white flex items-center justify-center"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">
                Gestión
            </div>

            <li>
                <a href="{{ route('admin.roles.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('admin.roles.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-shield-halved w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white flex items-center justify-center"></i>
                    <span class="ms-3">Roles y Permisos</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-users w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white flex items-center justify-center"></i>
                    <span class="ms-3">Usuarios</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.patients.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('admin.patients.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-user-injured w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white flex items-center justify-center"></i>
                    <span class="ms-3">Pacientes</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.doctors.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('admin.doctors.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-user-md w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white flex items-center justify-center"></i>
                    <span class="ms-3">Doctores</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

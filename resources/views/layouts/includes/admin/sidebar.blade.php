@php
//Arreglo de íconos
$links = [
    [
        'name' => 'Dashboard',
        'icon' => 'fa-solid fa-gauge',
        'href' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard'),
    ],
    [
        'header' => 'Gestión de Usuarios',
    ],
    [
        'name' => 'Pacientes',
        'icon' => 'fa-solid fa-user',
        'href' => '#',
        'active' => false,
    ],
    [
        'name' => 'Doctores',
        'icon' => 'fa-solid fa-user-md',
        'href' => '#',
        'active' => false,
    ],
    [
        'header' => 'Citas',
    ],
    [
        'name' => 'Calendario',
        'icon' => 'fa-solid fa-calendar',
        'href' => '#',
        'active' => false,
    ],
    [
        'name' => 'Historial',
        'icon' => 'fa-solid fa-history',
        'href' => '#',
        'active' => false,
    ]
];
@endphp

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
            <li>
                @isset($link['header'])
                    <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        {{ $link['header'] }}
                    </div>
                @else
                    <a href="{{ $link['href'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                        <i class="{{ $link['icon'] }} w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white {{ $link['active'] ? 'text-blue-600' : '' }}"></i>
                        <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                @endisset
            </li>
            @endforeach
        </ul>
    </div>
</aside>
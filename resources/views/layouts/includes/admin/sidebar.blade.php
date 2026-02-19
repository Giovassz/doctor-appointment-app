@php
//Arreglo de íconos
$links = [
    [
        'name' => 'Panel de Control',
        'icon' => 'fa-solid fa-gauge',
        'href' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard'),
    ],
    [
        'header' => 'Gestión',
    ],
    [
        'name' => 'Roles y Permisos',
        'icon' => 'fa-solid fa-shield-halved',
        'href' => route('admin.roles.index'),
        'active' => request()->routeIs('admin.roles.*'),
    ],
    [
        'name' => 'Usuarios',
        'icon' => 'fa-solid fa-users',
        'href' => route('admin.users.index'),
        'active' => request()->routeIs('admin.users.*'),
    ],
    [
        'name' => 'Pacientes',
        'icon' => 'fa-solid fa-user-injured',
        'href' => route('admin.patients.index'),
        'active' => request()->routeIs('admin.patients.*'),
    ],
    [
        'name' => 'Doctores',
        'icon' => 'fa-solid fa-user-doctor',
        'href' => route('admin.doctors.index'),
        'active' => request()->routeIs('admin.doctors.*'),
    ],
];
@endphp


<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-900 border-r border-gray-800 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-900">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
            <li>
                {{--Revisa si existe definido una llave llamada header--}}
                @isset($link['header'])
                    <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase">
                        {{ $link['header'] }}
                    </div>
                {{--Si no existe la llave header, uso la etiqueta como estaba definida antes--}}
                @else
                    {{--Revisa si existe un submenu--}}
                    @isset($link['submenu'])
                        <button type="button" 
                            class="flex items-center w-full p-2 text-base text-gray-300 transition duration-75 rounded-lg group hover:bg-gray-800 hover:text-white" 
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <span class="w-6 h-6 inline-flex justify-center items-center text-gray-400 group-hover:text-white transition duration-75">
                                <i class="{{ $link['icon'] }}"></i>  
                            </span>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $link['name'] }}</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" 
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                            @foreach ($link['submenu'] as $item)
                                <li>
                                 <a href="{{ $item['href'] }}" 
                                    class="flex items-center w-full p-2 text-gray-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-800 hover:text-white">
                                    {{$item['name']}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ $link['href'] }}"
                            class="flex items-center p-2 rounded-lg group transition-colors duration-200 {{ $link['active'] ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white border-transparent' }}">
                            <span class="w-6 h-6 inline-flex justify-center items-center {{ $link['active'] ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition duration-75">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </a>
                    @endisset
                @endisset
            </li>
            @endforeach
        </ul>
    </div>
</aside>
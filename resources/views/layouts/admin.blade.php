<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Updated</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/e9e74fca35.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        @livewireStyles
        
        <!-- Custom CSS to fix logo size -->
        <style>
            .logo-container img {
                max-width: 16px !important;
                max-height: 16px !important;
                width: 16px !important;
                height: 16px !important;
                object-fit: contain !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        
        <!-- Navigation Bar -->
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-2 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                            </svg>
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24 items-center logo-container">
                            <img src="{{ asset('images/healthy.png') }}" class="h-4 w-4 me-2 object-contain" alt="Healthify Logo" style="max-width: 16px; max-height: 16px;" />
                            <span class="self-center text-xs font-semibold whitespace-nowrap dark:text-white text-gray-800">Healthify</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}
                                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}"
                                                 @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside id="logo-sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen pt-14 transition-transform -translate-x-full bg-blue-800 border-r border-blue-700 sm:translate-x-0" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-2 text-white rounded-lg hover:bg-blue-700 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                            <svg class="w-5 h-5 text-gray-300 transition duration-75 group-hover:text-white" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-blue-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300 transition duration-75 group-hover:text-white" fill="currentColor" viewBox="0 0 18 21">
                                <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            <span class="flex-1 ml-3 text-left rtl:text-right whitespace-nowrap">E-commerce</span>
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-700">Products</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-700">Billing</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-700">Invoice</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <div class="px-2 py-2 text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Gestión de Usuarios
                        </div>
                    </li>
                    
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-blue-700" aria-controls="dropdown-users" data-collapse-toggle="dropdown-users">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300 transition duration-75 group-hover:text-white" fill="currentColor" viewBox="0 0 18 21">
                                <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            <span class="flex-1 ml-3 text-left rtl:text-right whitespace-nowrap">E-commerce</span>
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul id="dropdown-users" class="hidden py-2 space-y-2">
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-700">Pacientes</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-700">Doctores</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main content -->
        <div class="p-4 ml-64 mt-16">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>

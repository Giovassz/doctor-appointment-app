<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Gestor de horarios</h2>
                    <p class="text-sm text-gray-500">Doctor/a: {{ $doctor->user->name }}</p>
                </div>
                <x-wire-button primary label="Guardar horario" icon="save" />
            </div>

            <div class="overflow-x-auto mt-8">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
                    <thead class="bg-gray-50 uppercase text-xs font-semibold text-gray-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left tracking-wider border-b border-gray-200">DÍA/HORA</th>
                            <th scope="col" class="px-6 py-4 text-left tracking-wider border-b border-gray-200">LUNES</th>
                            <th scope="col" class="px-6 py-4 text-left tracking-wider border-b border-gray-200">MARTES</th>
                            <th scope="col" class="px-6 py-4 text-left tracking-wider border-b border-gray-200">MIÉRCOLES</th>
                            <th scope="col" class="px-6 py-4 text-left tracking-wider border-b border-gray-200">JUEVES</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- 08:00 Row --}}
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <x-wire-checkbox id="h08" />
                                    <span class="text-md font-bold text-gray-700">08:00:00</span>
                                </div>
                            </td>
                            @for ($i = 0; $i < 4; $i++)
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h08-all-{{$i}}" label="Todos" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h08-1-{{$i}}" label="08:00 - 08:15" checked="{{ $i < 3 }}" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h08-2-{{$i}}" label="08:15 - 08:30" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h08-3-{{$i}}" label="08:30 - 08:45" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h08-4-{{$i}}" label="08:45 - 09:00" />
                                    </div>
                                </div>
                            </td>
                            @endfor
                        </tr>
                        {{-- 09:00 Row --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <x-wire-checkbox id="h09" />
                                    <span class="text-md font-bold text-gray-700">09:00:00</span>
                                </div>
                            </td>
                            @for ($i = 0; $i < 4; $i++)
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h09-all-{{$i}}" label="Todos" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h09-1-{{$i}}" label="09:00 - 09:15" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h09-2-{{$i}}" label="09:15 - 09:30" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h09-3-{{$i}}" label="09:30 - 09:45" />
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <x-wire-checkbox id="h09-4-{{$i}}" label="09:45 - 10:00" />
                                    </div>
                                </div>
                            </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

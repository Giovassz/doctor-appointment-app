@props(['tab', 'error' => false])

<button type="button" 
    @click="tab = '{{ $tab }}'"
    :class="tab === '{{ $tab }}' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 py-4 px-1 border-b-2 font-medium text-sm flex items-center hover:text-gray-700 hover:border-gray-300'"
    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center {{ $error ? 'text-red-600 border-red-500' : '' }}"
    {{ $attributes }}
>
    {{ $slot }}
</button>

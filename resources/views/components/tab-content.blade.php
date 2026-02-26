@props(['tab'])

<div x-show="tab === '{{ $tab }}'" class="space-y-6" x-cloak {{ $attributes }}>
    {{ $slot }}
</div>

@props(['active'])

<div x-data="{ 
        tab: '{{ $active }}',
        focusError() {
            setTimeout(() => {
                const firstError = document.querySelector('.text-negative-600, .text-red-600, .border-red-500');
                if (firstError) {
                    const input = firstError.closest('div').querySelector('input, select, textarea');
                    if (input) input.focus();
                }
            }, 100);
        }
    }" 
    x-init="focusError()"
    {{ $attributes }}
>
    @if (isset($header))
        <div class="mb-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
                {{ $header }}
            </nav>
        </div>
    @endif

    <div class="p-4">
        {{ $slot }}
    </div>
</div>

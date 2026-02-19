<div class="flex items-center space-x-2">
    @can('doctors.edit')
        <x-wire-button href="{{ route('admin.doctors.edit', $doctor->id) }}" blue xs>
            <i class="fa-solid fa-pen-to-square"></i>
        </x-wire-button>
    @endcan

    @can('doctors.destroy')
        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este doctor?')">
            @csrf
            @method('DELETE')
            <x-wire-button type="submit" red xs>
                <i class="fa-solid fa-trash"></i>
            </x-wire-button>
        </form>
    @endcan
</div>

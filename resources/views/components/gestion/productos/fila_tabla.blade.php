@props([
    'codigo_producto',
    'nombre_producto',
    'descripcion_producto',
    'categoria',
    'marca',
    'id_producto',
    'eliminados' => false, // por defecto falso si no se pasa
])

<tr>
    <!-- Código del producto -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $codigo_producto }}
        </p>
    </td>

    <!-- Nombre del producto -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $nombre_producto }}
        </p>
    </td>

    <!-- Categoría -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $categoria }}
        </p>
    </td>
    <!-- Marca -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $marca }}
        </p>
    </td>

    <!-- Descripción -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $descripcion_producto }}
        </p>
    </td>

    <!-- Acciones -->
    <!-- Acciones -->
    <td class="p-4 border-b border-slate-200 text-center">
        <div class="flex justify-center gap-6">
            @if (!$eliminados)
                <!-- Botón Editar -->
                @if (auth()->user()->tienePermiso('Editar Productos'))
                    <a href="{{ route('producto.edit', $id_producto) }}" class="text-slate-800 hover:underline"
                        title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0L2.25 18.038v3.712h3.712L21.731 5.981a2.625 2.625 0 000-3.712z" />
                        </svg>
                    </a>
                @endif
                <!-- Botón Eliminar -->
                @if (auth()->user()->tienePermiso('Eliminar Productos'))
                    <button type="button" onclick="showDeleteModal('delete-modal-{{ $id_producto }}')"
                        class="text-red-600 hover:underline" title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                @endif

                <!-- Modal de confirmación para eliminar -->
                <x-ventanaFlotante.delete :modalId="'delete-modal-' . $id_producto" :action="route('producto.destroy', $id_producto)" :itemName="$nombre_producto"
                    question="¿Estás seguro de eliminar el producto?" />
            @else
                <!-- Botón Restaurar -->
                @if (auth()->user()->tienePermiso('Eliminar Productos'))
                    <form action="{{ route('producto.restore', $id_producto) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-green-600 hover:underline" title="Restaurar">
                            Restaurar
                        </button>
                    </form>
                @endif

                <x-ventanaFlotante.restore :modalId="'restore-modal-' . $id_producto" :action="route('producto.restore', $id_producto)" :itemName="$nombre_producto"
                    question="¿Estás seguro de restaurar al producto?" />

                <!-- Botón Restaurar (si está eliminado) -->
                {{-- @if (auth()->user()->tienePermiso('Eliminar Proveedores') && $estado === 'Inactivo')
                <button type="button" onclick="showRestoreModal('restore-modal-{{ $id_proveedor }}')"
                    class="text-green-600 hover:underline">
                    Restaurar
                </button>
            @endif --}}

            @endif
        </div>
    </td>
</tr>

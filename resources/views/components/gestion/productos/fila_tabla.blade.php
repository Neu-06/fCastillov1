@props([
    'codigo_producto',
    'nombre_producto',
    'descripcion_producto',
    'categoria',
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

    <!-- Descripción -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $descripcion_producto }}
        </p>
    </td>

    <!-- Acciones -->
    <td class="p-4 border-b border-slate-200 text-center">
        <div class="flex justify-center gap-6">
            @if(!$eliminados)
                <!-- Botón Editar -->
                <a href="{{ route('producto.edit', $id_producto) }}" class="text-slate-800 hover:underline" title="Editar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0L2.25 18.038v3.712h3.712L21.731 5.981a2.625 2.625 0 000-3.712z"/>
                    </svg>
                </a>

                <!-- Botón Eliminar -->
                <button type="button" onclick="showDeleteModal('delete-modal-{{ $id_producto }}')"
                        class="text-red-600 hover:underline" title="Eliminar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Ventana flotante para confirmar eliminación -->
                <x-ventanaFlotante.delete 
                    :modalId="'delete-modal-' . $id_producto" 
                    :action="route('producto.destroy', $id_producto)" 
                    :itemName="$nombre_producto"
                    question="¿Estás seguro de eliminar el producto?" />
            @else
                <!-- Botón Restaurar -->
                <form action="{{ route('producto.restore', $id_producto) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="text-green-600 hover:underline" title="Restaurar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 10h7v11H3V10zM20 10h-7v11h7V10zM4 10h16v-1a4 4 0 00-4-4h-8a4 4 0 00-4 4v1z" />
                        </svg>
                    </button>
                </form>
            @endif
        </div>
    </td>
</tr>

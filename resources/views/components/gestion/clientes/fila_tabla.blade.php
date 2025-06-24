@props(['nombre_cliente', 'apellido_cliente', 'correo_cliente', 'telefono_cliente', 'direccion_cliente', 'fecha_creacion', 'estado', 'id_cliente'])

<tr>
    <!-- Nombre completo y correo -->
    <td class="p-4 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="flex flex-col">
                <p class="text-sm font-semibold text-slate-700">
                    {{ $nombre_cliente . ' ' . $apellido_cliente }}
                </p>
                <p class="text-sm text-slate-500">
                    {{ $correo_cliente }}
                </p>
            </div>
        </div>
    </td>

    <!-- Teléfono -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-500">
            {{ $telefono_cliente }}
        </p>
    </td>

    <!-- Dirección -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-500">
            {{ $direccion_cliente }}
        </p>
    </td>

    <!-- Estado -->
    <td class="p-4 border-b border-slate-200">
        <div class="w-max ">
            <div
                class="relative grid items-center px-2 py-1 font-sans text-xs font-bold uppercase rounded-md select-none whitespace-nowrap 
                {{ $estado === 'Activo' ? 'text-green-900 bg-green-500/20' : 'text-red-900 bg-red-500/20' }}">
                <span>{{ $estado }}</span>
            </div>
        </div>
    </td>

    <!-- Fecha de creación -->
    <td class="p-4 border-b border-slate-200 ">
        <p class="text-sm text-slate-500">
            {{ $fecha_creacion }}
        </p>
    </td>

    <!-- Acciones -->
    <td class="p-4 border-b border-slate-200 text-center">
        <div class="flex justify-center gap-6">
            <!-- Botón Editar -->
            @if(auth()->user()->tienePermiso('Editar Clientes'))
            <a href="{{ route('cliente.edit', $id_cliente) }}" class="text-slate-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                    class="w-4 h-4">
                    <path
                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                    </path>
                </svg>
            </a>
            @endif
            <!-- Botón Eliminar -->
            @if(auth()->user()->tienePermiso('Eliminar Clientes') && $estado === 'Activo')
            <button type="button" onclick="showDeleteModal('delete-modal-{{ $id_cliente }}')" 
                class="text-red-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
             @endif

            <!-- Botón Restaurar (si está eliminado) -->
            @if(auth()->user()->tienePermiso('Eliminar Clientes') && $estado === 'Inactivo')
                <button type="button" onclick="showRestoreModal('restore-modal-{{ $id_cliente }}')"
                    class="text-green-600 hover:underline">
                    Restaurar
                </button>
            @endif
        </div>
    </td>
</tr>
@if(auth()->user()->tienePermiso('Eliminar Clientes'))
<x-ventanaFlotante.delete
    :modalId="'delete-modal-' . $id_cliente"
    :action="route('cliente.destroy', $id_cliente)"
    :itemName="$nombre_cliente . ' ' . $apellido_cliente"
    question="¿Estás seguro de eliminar al cliente?"
/>
@endif
@if(auth()->user()->tienePermiso('Eliminar Clientes'))
<x-ventanaFlotante.restore
    :modalId="'restore-modal-' . $id_cliente"
    :action="route('cliente.restore', $id_cliente)"
    :itemName="$nombre_cliente . ' ' . $apellido_cliente"
    question="¿Estás seguro de restaurar al cliente?"
/>
@endif
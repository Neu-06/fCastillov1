@props(['id_rol', 'nombre_rol'])

<tr>

    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $id_rol }}
        </p>
    </td>

    <!-- Rol -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $nombre_rol }}
        </p>
    </td>
    {{-- Ver mas --}}
    <td class="p-4 border-b border-slate-200 text-center">
<a href="{{ route('rol.permisos', $id_rol) }}" class="text-blue-600 hover:underline">
    Ver más
</a>

    </td>
    <!-- Acciones -->
    <td class="p-4 border-b border-slate-200 text-center">
        <div class="flex justify-center gap-6">

              <!-- Botón Editar -->
            @if(auth()->user()->tienePermiso('Editar Roles'))
            <a href="{{ route('rol.edit', $id_rol) }}" class="text-slate-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                    class="w-4 h-4">
                    <path
                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                    </path>
                </svg>
            </a>
            @endif

            <!-- Botón Eliminar -->
            @if(auth()->user()->tienePermiso('Eliminar Roles'))
            <button type="button" onclick="showDeleteModal('delete-modal-{{ $id_rol }}')" 
            class="text-red-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
            @endif
        </div>
    </td>
</tr>
@if(auth()->user()->tienePermiso('Eliminar Roles'))
<x-ventanaFlotante.delete
    :modalId="'delete-modal-' . $id_rol"
    :action="route('rol.destroy', $id_rol)"
    :itemName="$nombre_rol"
    question="¿Estás seguro de eliminar el rol?"
/>
@endif
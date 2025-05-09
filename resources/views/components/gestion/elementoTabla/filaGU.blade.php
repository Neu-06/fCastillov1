@props(['nombre_usuario', 'correo_usuario', 'nombre_rol', 'fecha_creacion', 'estado', 'id_usuario'])

<tr>
    <!-- Nombre y correo -->
    <td class="p-4 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="flex flex-col">
                <p class="text-sm font-semibold text-slate-700">
                    {{ $nombre_usuario }}
                </p>
                <p class="text-sm text-slate-500">
                    {{ $correo_usuario }}
                </p>
            </div>
        </div>
    </td>

    <!-- Rol -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $nombre_rol }}
        </p>
    </td>

    <!-- Estado -->
    <td class="p-4 border-b border-slate-200">
        <div class="w-max">
            <div
                class="relative grid items-center px-2 py-1 font-sans text-xs font-bold uppercase rounded-md select-none whitespace-nowrap 
                {{ $estado === 'Activo' ? 'text-green-900 bg-green-500/20' : 'text-red-900 bg-red-500/20' }}">
                <span>{{ $estado }}</span>
            </div>
        </div>
    </td>

    <!-- Fecha de creación -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-500">
            {{ $fecha_creacion }}
        </p>
    </td>

    <!-- Acciones -->
    <td class="p-4 border-b border-slate-200 text-center">
        <div class="flex justify-center gap-2">
            <!-- Botón Editar -->
            <a href="{{ route('usuario.edit', $id_usuario) }}" class="text-blue-600 hover:underline">
                Editar
            </a>

            <!-- Botón Eliminar -->
            <form action="{{ route('usuario.destroy', $id_usuario) }}" method="POST"
                onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">
                    Eliminar
                </button>
            </form>

            <!-- Botón Restaurar (si está eliminado) -->
            @if ($estado === 'Inactivo')
                <form action="{{ route('usuario.restore', $id_usuario) }}" method="POST"
                    onsubmit="return confirm('¿Estás seguro de restaurar este usuario?')">
                    @csrf
                    <button type="submit" class="text-green-600 hover:underline">
                        Restaurar
                    </button>
                </form>
            @endif
        </div>
    </td>
</tr>

<div class="overflow-x-auto overflow-y-auto max-h-screen border rounded-lg">
    <table class="min-w-full bg-white text-sm text-gray-800">
        <thead>
            <tr class="bg-gray-100 text-gray-700 text-sm">
                <th class="py-3 px-6 text-left">Caso de Uso</th>
                <th class="py-3 px-6 text-center">Agregar</th>
                <th class="py-3 px-6 text-center">Editar</th>
                <th class="py-3 px-6 text-center">Eliminar</th>
                <th class="py-3 px-6 text-center">Ver</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($casosDeUso as $modulo => $nombreVisible)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4 font-medium">{{ $nombreVisible }}</td>
                    @foreach (['Agregar', 'Editar', 'Eliminar', 'Ver'] as $accion)
                        @php
                            $permiso = $permisos->firstWhere('nombre_permiso', "$accion $modulo");
                            $tienePermiso = $permiso && $rol->permisos->contains('id_permiso', $permiso->id_permiso);
                        @endphp
                        <td class="text-center py-2 px-4">
                            @if (isset($soloLectura) && $soloLectura)
                                @if ($tienePermiso)
                                    <svg class="inline-block w-5 h-5 text-green-500" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <span class="text-gray-400 font-semibold select-none">—</span>
                                @endif
                            @else
                                @if ($permiso)
                                    <input type="checkbox" name="permisos[]" value="{{ $permiso->id_permiso }}"
                                        {{ $tienePermiso ? 'checked' : '' }}>
                                @else
                                    <span class="text-gray-400 text-lg font-semibold select-none">—</span>
                                @endif
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach

        
        </tbody>
    </table>
</div>

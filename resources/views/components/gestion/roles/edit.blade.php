@props(['rol', 'permisos', 'casosDeUso'])


<form method="POST" action="{{ route('rol.update', $rol->id_rol) }}">
    @csrf
    @method('PUT')
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-3xl mx-auto">
        <div class="space-y-6">
            <h1 class="text-center text-2xl font-semibold text-gray-600 mb-4">Editar Rol</h1>

            <!-- Nombre del Rol -->
            <div>
                <label for="nombre_rol" class="block mb-1 text-gray-600 font-semibold">Nombre del Rol</label>
                <input type="text" name="nombre_rol" id="nombre_rol" value="{{ old('nombre_rol', $rol->nombre_rol) }}"
                    required
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border 
    {{ $errors->has('nombre_rol') ? 'border-red-400' : 'border-blue-200' }} 
    focus:ring-2 focus:ring-blue-400 transition" />
                @error('nombre_rol')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lista de permisos -->
            <div>
                <h2 class="text-lg font-semibold text-slate-700 mb-2">Permisos del Rol</h2>
                <table class="min-w-full bg-white border border-gray-200 rounded-lg text-sm text-gray-800">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-sm">
                            <th class="py-2 px-4 text-left">Caso de Uso</th>
                            <th class="py-2 px-4 text-center">Agregar</th>
                            <th class="py-2 px-4 text-center">Editar</th>
                            <th class="py-2 px-4 text-center">Eliminar</th>
                            <th class="py-2 px-4 text-center">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($casosDeUso as $caso)
                            @php
                                $modulo = str_replace('Gestionar ', '', $caso);
                            @endphp
                            <tr class="border-t hover:bg-gray-50">
                                <td class="py-2 px-4 font-medium">{{ $caso }}</td>
                                @foreach (['Agregar', 'Editar', 'Eliminar', 'Ver'] as $accion)
                                    @php
                                        $permiso = $permisos->firstWhere('nombre_permiso', "$accion $modulo");
                                        $tienePermiso =
                                            $permiso && $rol->permisos->contains('id_permiso', $permiso->id_permiso);
                                    @endphp
                                    <td class="text-center">
                                        @if ($permiso)
                                            <input type="checkbox" name="permisos[]" value="{{ $permiso->id_permiso }}"
                                                {{ $tienePermiso ? 'checked' : '' }}>
                                        @else
                                            <span class="text-gray-400 font-semibold select-none">—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                @error('permisos')
                    <div class="mt-2 px-4 py-2 bg-red-100 border border-red-300 text-red-700 text-sm rounded-md">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-between gap-4 mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Actualizar
                </button>
                <a href="{{ route('rol.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
</form>

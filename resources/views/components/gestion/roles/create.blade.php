<form action="{{ route('rol.store') }}" method="POST" class="space-y-6">
    @csrf
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-5xl mx-auto">
        <div class="space-y-6">
            {{-- Título del formulario --}}
            <h1 class="text-center text-2xl font-semibold text-gray-700">Registrar Nuevo Rol</h1>

            {{-- Campo: Nombre de Rol --}}
            <div>
                <label for="nombre_rol" class="block mb-1 text-gray-600 font-semibold">Nombre de Rol</label>
                <input type="text" name="nombre_rol" id="nombre_rol" value="{{ old('nombre_rol') }}" required
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border 
            {{ $errors->has('nombre_rol') ? 'border-red-400' : 'border-blue-200' }} 
            focus:ring-2 focus:ring-blue-400 transition" />
                @error('nombre_rol')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tabla de Permisos --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Asignar Permisos al Rol</h2>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    @php
                        // Crear un objeto Rol vacío que no se guarda en la base de datos
                        $rol = new \App\Models\Rol();

                        // Simular la relación permisos vacía (importante para evitar errores con contains())
                        $rol->setRelation('permisos', collect());
                    @endphp

                    @include('components.gestion.roles.tabla_permisos', [
                        'rol' => $rol,
                        'permisos' => $permisos,
                        'casosDeUso' => $casosDeUso,
                    ])
                    @error('permisos')
                        <div class="mt-2 px-4 py-2 bg-red-100 border border-red-300 text-red-700 text-sm rounded-md">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- o <x-gestion.roles.tabla-permisos /> --}}
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex justify-between pt-6">
                <button type="submit"
                    class="bg-blue-600 text-white py-2 px-6 rounded-lg font-bold shadow hover:bg-blue-700 transition">
                    Registrar
                </button>
                <a href="{{ route('rol.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-6 rounded-lg transition shadow">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
</form>

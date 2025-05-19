@props(['roles', 'usuario'])

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('usuario.update', $usuario->id_usuario) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-sm mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-600 mb-4">Editar Usuario</h1>
            <div>
                <label for="nombre_usuario" class="block mb-1 text-gray-600 font-semibold">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" required
                    value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="correo_usuario" class="block mb-1 text-gray-600 font-semibold">Correo Electrónico</label>
                <input type="email" name="correo_usuario" id="correo_usuario" required
                    value="{{ old('correo_usuario', $usuario->correo_usuario) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="id_rol" class="block mb-1 text-gray-600 font-semibold">Rol</label>
                <select name="id_rol" id="id_rol" required
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}"
                            {{ old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                            {{ $rol->nombre_rol }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex justify-between gap-4 mt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                Actualizar
            </button>
            <a href="{{ route('usuario.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                Cancelar
            </a>
        </div>
    </div>
</form>

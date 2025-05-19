@props(['roles'])

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('usuario.store') }}" method="POST" class="space-y-6">
    @csrf
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-sm mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-600">Registrar Nuevo Usuario</h1>
            <div>
                <label for="nombre_usuario" class="block mb-1 text-gray-600 font-semibold">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" required
                    value="{{ old('nombre_usuario') }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                />
            </div>
            <div>
                <label for="correo_usuario" class="block mb-1 text-gray-600 font-semibold">Correo Electrónico</label>
                <input type="email" name="correo_usuario" id="correo_usuario" required
                    value="{{ old('correo_usuario') }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                />
            </div>
            <div>
                <label for="password_usuario" class="block mb-1 text-gray-600 font-semibold">Contraseña <span class="text-xs text-gray-500">Mínimo 6 caracteres</span></label>
                <div class="relative">
                    <input type="password" name="password_usuario" id="password_usuario" required minlength="6"
                        class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition pr-10" />
                    <button type="button" tabindex="-1"
                        onclick="document.getElementById('password_usuario').type = document.getElementById('password_usuario').type === 'password' ? 'text' : 'password'; this.querySelector('svg').classList.toggle('hidden'); this.querySelectorAll('svg')[1].classList.toggle('hidden');"
                        class="absolute inset-y-0 right-0 flex items-center px-3 focus:outline-none">
                        <!-- Ojo cerrado -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-1.657.336-3.234.938-4.675m1.675-1.675A9.956 9.956 0 0112 3c5.523 0 10 4.477 10 10 0 1.657-.336 3.234-.938 4.675m-1.675 1.675A9.956 9.956 0 0112 21c-5.523 0-10-4.477-10-10 0-1.657.336-3.234.938-4.675" />
                        </svg>
                        <!-- Ojo abierto (hidden por defecto) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a9.77 9.77 0 01-1.5 3.5M2.5 12a9.77 9.77 0 011.5-3.5m15.5 3.5a9.77 9.77 0 01-1.5 3.5m-13-3.5a9.77 9.77 0 011.5-3.5m13 0A9.77 9.77 0 0121.5 12m-19 0A9.77 9.77 0 012.5 12" />
                        </svg>
                    </button>
                </div>
                
            </div>
            <div>
                <label for="id_rol" class="block mb-1 text-gray-600 font-semibold">Rol</label>
                <select name="id_rol" id="id_rol" required
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}" {{ old('id_rol') == $rol->id_rol ? 'selected' : '' }}>
                            {{ $rol->nombre_rol }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex justify-between mt-6">
            <button type="submit"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg font-bold shadow hover:bg-blue-700 transition">
                Registrar
            </button>
            <a href="{{ route('usuario.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                Cancelar
            </a>
        </div>
    </div>
</form>


@props(['cliente'])

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cliente.update', $cliente->id_cliente) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-sm mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-600 mb-4">Editar Cliente</h1>
            <div>
                <label for="nombre_cliente" class="block mb-1 text-gray-600 font-semibold">Nombre</label>
                <input type="text" name="nombre_cliente" id="nombre_cliente" required
                    value="{{ old('nombre_cliente', $cliente->nombre_cliente) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="apellido_cliente" class="block mb-1 text-gray-600 font-semibold">Apellido</label>
                <input type="text" name="apellido_cliente" id="apellido_cliente" required
                    value="{{ old('apellido_cliente', $cliente->apellido_cliente) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="correo_cliente" class="block mb-1 text-gray-600 font-semibold">Correo Electrónico</label>
                <input type="email" name="correo_cliente" id="correo_cliente" required
                    value="{{ old('correo_cliente', $cliente->correo_cliente) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="telefono_cliente" class="block mb-1 text-gray-600 font-semibold">Teléfono</label>
                <input type="text" name="telefono_cliente" id="telefono_cliente" pattern="[0-9]*" inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    value="{{ old('telefono_cliente', $cliente->telefono_cliente) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="direccion_cliente" class="block mb-1 text-gray-600 font-semibold">Dirección</label>
                <input type="text" name="direccion_cliente" id="direccion_cliente"
                    value="{{ old('direccion_cliente', $cliente->direccion_cliente) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
        </div>
        <div class="flex justify-between gap-4 mt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                Actualizar
            </button>
            <a href="{{ route('cliente.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                Cancelar
            </a>
        </div>
    </div>
</form>

@props(['proveedor'])

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('proveedor.edit', $proveedor->id_proveedor) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-sm mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-600 mb-4">Editar Proveedor</h1>
            <div>
                <label for="nombreC_proveedor" class="block mb-1 text-gray-600 font-semibold">Nombre Completo</label>
                <input type="text" name="nombreC_proveedor" id="nombreC_proveedor" required
                    value="{{ old('nombreC_proveedor', $proveedor->nombreC_proveedor) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="correo_proveedor" class="block mb-1 text-gray-600 font-semibold">Correo Electrónico</label>
                <input type="email" name="correo_proveedor" id="correo_proveedor" required
                    value="{{ old('correo_proveedor', $proveedor->correo_proveedor) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="telefono_proveedor" class="block mb-1 text-gray-600 font-semibold">Teléfono</label>
                <input type="text" name="telefono_proveedor" id="telefono_proveedor" required
                    pattern="[0-9]*" inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    value="{{ old('telefono_proveedor', $proveedor->telefono_proveedor) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
            <div>
                <label for="direccion_proveedor" class="block mb-1 text-gray-600 font-semibold">Dirección</label>
                <input type="text" name="direccion_proveedor" id="direccion_proveedor" required
                    value="{{ old('direccion_proveedor', $proveedor->direccion_proveedor) }}"
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
        </div>
        <div class="flex justify-between gap-4 mt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                Actualizar
            </button>
            <a href="{{ route('proveedor.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                Cancelar
            </a>
        </div>
    </div>
</form>

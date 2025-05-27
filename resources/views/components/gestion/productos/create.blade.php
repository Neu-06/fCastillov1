@props(['categorias', 'marcas'])

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-md mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-600">Registrar Nuevo Producto</h1>

            <!-- Código -->
            <div>
                <label for="codigo_producto" class="block mb-1 text-gray-600 font-semibold">Código del Producto</label>
                <input type="text" name="codigo_producto" id="codigo_producto" required
                    value="{{ old('codigo_producto') }}"
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Nombre -->
            <div>
                <label for="nombre_producto" class="block mb-1 text-gray-600 font-semibold">Nombre del Producto</label>
                <input type="text" name="nombre_producto" id="nombre_producto" required
                    value="{{ old('nombre_producto') }}"
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block mb-1 text-gray-600 font-semibold">Descripción</label>
                <input type="text" name="descripcion" id="descripcion"
                    value="{{ old('descripcion') }}"
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Categoría -->
            <div>
                <label for="id_categoria" class="block mb-1 text-gray-600 font-semibold">Categoría</label>
                <select name="id_categoria" id="id_categoria" required
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}" {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- marca --}}
            <div>
                <label for="id_marca" class="block mb-1 text-gray-600 font-semibold">Marca</label>
                <select name="id_marca" id="id_marca" required
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    <option value="">Seleccione una Marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id_marca }}" {{ old('id_marca') == $marca->id_marca ? 'selected' : '' }}>
                            {{ $marca->nombre_marca }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Imágenes -->
            <div>
                <label for="imagenes" class="block mb-1 text-gray-600 font-semibold">Imágenes del Producto</label>
                <input type="file" name="imagenes[]" multiple
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
                <small class="text-xs text-gray-500">Puede subir varias imágenes (jpg, png)</small>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-between mt-6">
            <button type="submit"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg font-bold shadow hover:bg-blue-700 transition">
                Registrar
            </button>
            <a href="{{ route('producto.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                Cancelar
            </a>
        </div>
    </div>
</form>



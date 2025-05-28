@props(['producto', 'categorias', 'marcas'])

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('producto.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data"
    class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-md mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-600 mb-4">Editar Producto</h1>

            <!-- Código -->
            <div>
                <label for="codigo_producto" class="block mb-1 text-gray-600 font-semibold">Código del Producto</label>
                <input type="text" name="codigo_producto" id="codigo_producto" required
                    value="{{ old('codigo_producto', $producto->codigo_producto) }}"
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Nombre -->
            <div>
                <label for="nombre_producto" class="block mb-1 text-gray-600 font-semibold">Nombre del Producto</label>
                <input type="text" name="nombre_producto" id="nombre_producto" required
                    value="{{ old('nombre_producto', $producto->nombre_producto) }}"
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block mb-1 text-gray-600 font-semibold">Descripción</label>
                <input type="text" name="descripcion" id="descripcion"
                    value="{{ old('descripcion', $producto->detalle->descripcion ?? '') }}"
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Categoría -->
            <div>
                <label for="id_categoria" class="block mb-1 text-gray-600 font-semibold">Categoría</label>
                <select name="id_categoria" id="id_categoria" required
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition">
                    <option value="">Sin categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}"
                            {{ old('id_categoria', $producto->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Marca -->
            <div>
                <label for="id_marca" class="block mb-1 text-gray-600 font-semibold">Marca</label>
                <select name="id_marca" id="id_marca" required
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition">
                    <option value="">Seleccione una marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id_marca }}"
                            {{ old('id_marca', $producto->detalle->id_marca ?? '') == $marca->id_marca ? 'selected' : '' }}>
                            {{ $marca->nombre_marca }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 🖼 Imágenes actuales con opción para eliminar -->
            @if ($producto->detalle && $producto->detalle->imagenes->count())
                <div class="mt-6">
                    <label class="block mb-1 text-gray-600 font-semibold">Imágenes Actuales</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($producto->detalle->imagenes as $imagen)
                            <div class="relative group" id="imagen-{{ $imagen->id_imagen }}">
                                <img src="{{ $imagen->ruta_imagen }}"
                                    class="w-28 h-28 object-cover rounded shadow border border-gray-300">

                                <!-- Botón X para eliminar visualmente -->
                                <button type="button" onclick="eliminarImagen('{{ $imagen->id_imagen }}')"
                                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1 py-0.5 rounded-full cursor-pointer"
                                    title="Eliminar imagen">
                                    ❌
                                </button>

                                <!-- Checkbox oculto que será enviado al backend -->
                                <input type="checkbox" name="imagenes_eliminar[]" value="{{ $imagen->id_imagen }}"
                                    id="check-{{ $imagen->id_imagen }}" class="hidden">
                            </div>
                        @endforeach
                    </div>
                    <small class="text-xs text-gray-500 mt-1 block">Marca las imágenes que deseas eliminar.</small>
                </div>
            @endif
            <!-- 📤 Nuevas imágenes -->
            <div class="mt-6">
                <label for="imagenes" class="block mb-1 text-gray-600 font-semibold">Subir nuevas imágenes
                    (opcional)</label>
                <input type="file" name="imagenes[]" multiple
                    class="bg-indigo-50 px-4 py-2 rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 transition" />
                <small class="text-xs text-gray-500">Puedes subir nuevas imágenes para agregar o reemplazar las
                    actuales.</small>
            </div>

            <!-- Botones -->
            <div class="flex justify-between mt-6">
                <button type="submit"
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg font-bold shadow hover:bg-blue-700 transition">
                    Actualizar
                </button>
                <a href="{{ route('producto.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                    Cancelar
                </a>
            </div>
        </div>
</form>

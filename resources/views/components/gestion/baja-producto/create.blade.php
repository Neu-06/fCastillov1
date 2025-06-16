<!-- Contenedor principal centrado -->
<div class="flex justify-center items-center min-h-screen">
    <!-- Card del formulario -->
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        
        <!-- Título del formulario -->
        <h2 class="text-xl font-bold mb-2 text-gray-800 text-center">Buscar Producto</h2>
        <p class="text-sm text-gray-500 mb-4 text-center">
            Ingresá el código o nombre del producto para darlo de baja.
        </p>

        <!-- Formulario de búsqueda -->
        <form method="POST" action="{{ route('bajaproducto.buscar') }}">
            @csrf

            <!-- Campo de búsqueda -->
            <label for="busqueda" class="block text-sm font-medium text-gray-700 mb-1">
                Código o nombre del producto:
            </label>
            <input type="text" name="busqueda" id="busqueda"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                placeholder="Ej: 111P o Cemento" required>

            <!-- Error de validación -->
            @error('busqueda')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Botones de acción -->
            <div class="flex justify-end mt-6 space-x-2">
                <a href="{{ route('bajaproducto.index') }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Siguiente
                </button>
            </div>
        </form>
    </div>
</div>

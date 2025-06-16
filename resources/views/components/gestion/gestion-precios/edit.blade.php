<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6 space-y-4">
        <h2 class="text-xl font-bold text-center text-gray-700">Editar Porcentaje de Ganancia</h2>

        <form action="{{ route('gestionprecios.update', $producto->id_producto) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Código del producto -->
            <div>
                <label class="block text-gray-600 font-semibold">Código del producto</label>
                <input type="text" value="{{ $producto->codigo_producto }}" disabled
                    onclick="alert('Este campo no es editable')"
                    class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2 text-sm cursor-not-allowed">
            </div>

            <!-- Nombre del producto -->
            <div>
                <label class="block text-gray-600 font-semibold">Nombre del producto</label>
                <input type="text" value="{{ $producto->nombre_producto }}" disabled
                    onclick="alert('Este campo no es editable')"
                    class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2 text-sm cursor-not-allowed">
            </div>

            <!-- Precio de compra -->
            <div>
                <label class="block text-gray-600 font-semibold">Precio de compra</label>
                <input type="text" value="${{ number_format($producto->precio_compra, 2) }}" disabled
                    onclick="alert('Este campo no es editable')"
                    class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2 text-sm cursor-not-allowed">
            </div>

            <!-- Precio de venta -->
            <div>
                <label class="block text-gray-600 font-semibold">Precio de venta</label>
                <input type="text" value="${{ number_format($producto->precio_venta, 2) }}" disabled
                    onclick="alert('Este campo no es editable')"
                    class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2 text-sm cursor-not-allowed">
            </div>

            <!-- Porcentaje de ganancia -->
            <div>
                <label class="block text-gray-600 font-semibold">Porcentaje de ganancia (%)</label>
                <input
                   type="text"
                   name="ganancia"
                   id="ganancia"
                   value="{{ old('ganancia', $producto->ganancia ?? '') }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   inputmode="decimal"
                   pattern="^\d+(\.\d{1,2})?$"
                   placeholder="Ejemplo: 50 o 50.5"
                   required>
                    
                </div>

            <!-- Botones -->
            <div class="flex justify-between">
                <a href="{{ route('gestionprecios.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('ganancia').addEventListener('keypress', function (e) {
    const char = String.fromCharCode(e.which);
    const valid = /^[0-9.]$/.test(char);
    if (!valid) {
        e.preventDefault();
    }
});
</script>


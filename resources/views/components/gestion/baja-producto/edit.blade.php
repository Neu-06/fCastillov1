{{-- Título del formulario --}}
<h2 class="text-xl font-bold text-gray-800 mb-2">Formulario de Registro de Baja</h2>
<p class="text-sm text-gray-500 mb-6">Ingresá los detalles de la baja del producto seleccionado.</p>

<form action="{{ route('bajaproducto.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    @csrf

    {{-- Campo oculto con el ID del producto (enviado para asociar la baja con el producto correcto) --}}
    <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">

    {{-- Campo solo lectura: Código del Producto --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Código del Producto</label>
        <input type="text" value="{{ $producto->codigo_producto }}" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded" readonly>
    </div>

    {{-- Campo solo lectura: Nombre del Producto --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
        <input type="text" value="{{ $producto->nombre_producto }}" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded" readonly>
    </div>

    {{-- Campo solo lectura: Stock Disponible --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Stock Disponible</label>
        <input type="text" value="{{ $producto->stock }}" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded" readonly>
    </div>

    {{-- Campo editable: Cantidad de productos a dar de baja --}}
    <div class="mb-4">
        <label for="cantidad_baja" class="block text-sm font-medium text-gray-700">Cantidad del Producto a dar de Baja</label>
        <input type="number" name="cantidad_baja" class="w-full px-3 py-2 border border-gray-300 rounded" placeholder="Ej: 5 o 12" required min="1">
    </div>

    {{-- Campo editable: Motivo de la baja --}}
    <div class="mb-6">
        <label for="motivo_baja" class="block text-sm font-medium text-gray-700">Motivo</label>
        <textarea name="motivo_baja" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded" placeholder="Ej: Producto dañado - 3 bolsas de cemento" required></textarea>
    </div>

    {{-- Botones: Cancelar y Confirmar baja --}}
    <div class="flex justify-between">
        <a href="{{ route('bajaproducto.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Confirmar baja
        </button>
    </div>
</form>

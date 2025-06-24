@if (isset($baja))
    {{-- Fila para bajas realizadas --}}
<tr class="odd:bg-white even:bg-gray-50 hover:bg-blue-50 transition">
    {{-- Código del producto (centrado) --}}
    <td class="px-4 py-2 text-sm text-gray-700 text-center border-b border-gray-200">
        {{ $baja->producto->codigo_producto ?? '—' }}
    </td>

    {{-- Nombre del producto (alineado a la izquierda) --}}
    <td class="px-4 py-2 text-sm text-gray-700 font-semibold border-b border-gray-200">
        {{ $baja->producto->nombre_producto ?? '—' }}
    </td>

    {{-- Cantidad de baja (centrado, dentro de badge) --}}
    <td class="px-4 py-2 text-sm text-center border-b border-gray-200">
        <span class="inline-block px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-300 rounded">
            {{ intval($baja->cantidad_baja) }}
        </span>
    </td>

    {{-- Motivo (alineado a la izquierda) --}}
    <td class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
        {{ $baja->motivo_baja }}
    </td>

    {{-- Fecha (centrado, en formato d/m/Y) --}}
    <td class="px-4 py-2 text-sm text-gray-500 text-center border-b border-gray-200">
        {{ $baja->created_at->format('d/m/Y') }}
    </td>
</tr>

@elseif (isset($producto))
<tr class="odd:bg-white even:bg-gray-50 hover:bg-blue-50 transition">
    {{-- Código del producto (centrado) --}}
    <td class="px-4 py-2 text-sm text-gray-700 text-center border-b border-gray-200">
        {{ $producto->codigo_producto }}
    </td>

    {{-- Nombre del producto (izquierda, normal) --}}
    <td class="px-4 py-2 text-sm text-gray-700 font-semibold border-b border-gray-200">
        {{ $producto->nombre_producto }}
    </td>

    {{-- Stock disponible (centrado) --}}
    <td class="px-4 py-2 text-sm text-center border-b border-gray-200">
        @if ($producto->stock <= 10)
            <span class="inline-block px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 border border-red-300 rounded">
                {{ $producto->stock }}
            </span>
        @else
            <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 border border-green-300 rounded">
                {{ $producto->stock }}
            </span>
        @endif
    </td>
</tr>
@endif


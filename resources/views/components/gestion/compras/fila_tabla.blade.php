@props([
    'id_compra',
    'nombre_proveedor',
    'total_compra',
    'fecha_compra',
])

<tr>
    <!-- ID Compra -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $id_compra }}
        </p>
    </td>

    <!-- Nombre del Proveedor -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $nombre_proveedor }}
        </p>
    </td>
    <!-- Fecha de la Compra -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-500">
            {{ $fecha_compra }}
        </p>
    </td>
    <!-- Total de la Compra -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            ${{ number_format((float)$total_compra, 2) }}
        </p>
    </td>
    <td class="p-4 border-b border-slate-200">
        <a href="{{ route('compra.show', $id_compra) }}" class="text-blue-600 hover:underline">
         Ver detalles
        </a>
    </td>
  
</tr>
</tr>


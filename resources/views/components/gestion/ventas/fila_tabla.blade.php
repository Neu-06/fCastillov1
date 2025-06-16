@props([
    'id_venta',
    'nombre_usuario',
    'nombre_cliente',
    'total_venta',
    'fecha_venta',
])

<tr>
    <!-- ID Compra -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $id_venta }}
        </p>
    </td>

    <!-- Nombre del Proveedor -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $nombre_usuario }}
        </p>
    </td>
    <!-- Nombre del Proveedor -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $nombre_cliente }}
        </p>
    </td>
   
    <!-- Total de la Compra -->
<td class="p-4 border-b border-slate-200">
    <p class="text-sm font-semibold text-slate-700">
        ${{ number_format((float) $total_venta, 2) }}
    </p>
</td>


    <!-- Fecha de la Compra -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-500">
            {{ $fecha_venta }}
        </p>
    </td>
    <td class="p-4 border-b border-slate-200">
        <a href="{{ route('venta.show', $id_venta) }}" class="text-blue-600 hover:underline">
         Ver detalles
        </a>
    </td>
</tr>


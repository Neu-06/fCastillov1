@props([
    'id_venta',
    'nombre_usuario',
    'nombre_cliente',
    'nombre_producto',
    'descripcion',
    'precio',
    'cantidad',
     'subtotal',
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
     <!-- Nombre del Producto -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $nombre_producto }}
        </p>
    </td>
     <!-- Nombre del Producto -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $descripcion }}
        </p>
    </td>
     <!-- Nombre del Producto -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $precio }}
        </p>
    </td>
     <!-- Nombre del Producto -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-700">
            {{ $cantidad }}
        </p>
    </td>
     <!-- Total de la Compra -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            ${{ number_format($subtotal, 2) }}
        </p>
    </td>
    <!-- Fecha de la Compra -->
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm text-slate-500">
            {{ $fecha_venta }}
        </p>
    </td>
   
    
</tr>
</tr>


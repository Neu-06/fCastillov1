<tr class="odd:bg-white even:bg-gray-50 hover:bg-blue-50 transition border-b">

    <!-- Código del producto -->
    <td class="px-4 py-2 text-sm text-center text-gray-800">
        {{ $producto->codigo_producto }}
    </td>

    <!-- Nombre del producto -->
    <td class="px-4 py-2 text-sm text-left font-semibold text-gray-900">
        {{ $producto->nombre_producto }}
    </td>

  <!-- Stock disponible -->
     <td class="px-4 py-2 text-sm text-center">
     @if($producto->stock <= 10)

        <span class="inline-block px-2 py-0.5 bg-red-100 text-red-700 rounded text-xs font-medium">
            {{ $producto->stock }}
        </span>
     @else
        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs font-medium">
            {{ $producto->stock }}
        </span>
     @endif
     </td>


    <!-- Precio de compra -->
    <td class="px-4 py-2 text-sm text-center">
        <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs font-medium">
            ${{ number_format($producto->precio_compra, 2) }}
        </span>
    </td>

    <!-- Precio de venta -->
    <td class="px-4 py-2 text-sm text-center">
        <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs font-medium">
            ${{ number_format($producto->precio_venta, 2) }}
        </span>
    </td>

    <!-- Botón de editar -->
    <td class="px-4 py-2 text-sm text-center">
       <a href="{{ route('gestionprecios.edit', $producto->id_producto) }}"
       title="Editar"
       class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded hover:bg-blue-200 transition">
       ✏️
      </a>
    </td>

</tr>

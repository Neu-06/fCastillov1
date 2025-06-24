@if (!empty($mostrarBajas))
<tr class="bg-gray-100 text-gray-700 text-sm uppercase text-left">
    <th class="px-4 py-2 text-center">Código</th>
    <th class="px-4 py-2">Nombre producto</th>
    <th class="px-4 py-2 text-center">Cantidad de baja</th>
    <th class="px-4 py-2">Motivo de baja</th>
    <th class="px-4 py-2 text-center">Fecha</th>
</tr>

@else
<tr class="bg-gray-100 text-gray-700 text-sm uppercase text-left">
    <th class="px-4 py-2 text-center">Código</th>
    <th class="px-4 py-2">Nombre del producto</th>
    <th class="px-4 py-2 text-center">Stock disponible</th>
</tr>

@endif

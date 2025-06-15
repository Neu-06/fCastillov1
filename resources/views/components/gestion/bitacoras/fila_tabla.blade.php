@props(['accion', 'descripcion', 'nombre_usuario', 'ip_origen', 'fecha_hora'])

<tr>
    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $accion }}
        </p>
    </td>

    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $descripcion }}
        </p>
    </td>

    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $nombre_usuario }}
        </p>
    </td>

    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $ip_origen }}
        </p>
    </td>

    <td class="p-4 border-b border-slate-200">
        <p class="text-sm font-semibold text-slate-700">
            {{ $fecha_hora }}
        </p>
    </td>

</tr>
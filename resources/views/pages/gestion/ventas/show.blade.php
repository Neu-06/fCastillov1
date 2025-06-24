@extends('layouts.panelAdmin')

@section('title', 'Gestión de Compras')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Compras',
        'subtitulo' => 'Lista de Compras.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.ventas_detalle.header_tabla />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.ventas_detalle.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                       @foreach ($ventas as $venta)
    @foreach ($venta->detalle as $detalle)
        <x-gestion.ventas_detalle.fila_tabla
            id_venta="{{ $venta->id_venta }}"
            nombre_usuario="{{ $venta->usuario->nombre_usuario ?? 'Sin usuario' }}"
            nombre_cliente="{{ $venta->cliente->nombre_cliente ?? 'Sin cliente' }}"
            nombre_producto="{{ $detalle->producto->nombre_producto ?? 'Sin producto' }}"
            descripcion="{{ $detalle->producto->descripcion ?? 'Sin producto' }}"
            precio="{{ number_format($detalle->precio, 2) }}"
            cantidad="{{ number_format($detalle->cantidad, 2) }}"
            subtotal="{{ number_format($detalle->subtotal, 2) }}"
            fecha_venta="{{ $venta->created_at->format('d/m/Y') }}"
        />
    @endforeach
@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

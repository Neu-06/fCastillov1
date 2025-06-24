@extends('layouts.panelAdmin')

@section('title', 'Gestión de Compras')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Compras',
        'subtitulo' => 'Lista de Compras.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.compras_detalle.header_tabla />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.compras_detalle.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                       @foreach ($compras as $compra)
                       <!-- $compra->detalles eso va y busca el metodo detalles en el  -->
                        <!-- modelo compra para asi obtener los detalles de la compra -->
    @foreach ($compra->detalles as $detalle)
        <x-gestion.compras_detalle.fila_tabla
            id_compra="{{ $compra->id_compra }}"
            nombre_proveedor="{{ $compra->proveedor->nombreC_proveedor ?? 'Sin proveedor' }}"
            nombre_producto="{{ $detalle->producto->nombre_producto ?? 'Sin producto' }}"
            descripcion="{{ $detalle->producto->descripcion ?? 'Sin producto' }}"
            precio="{{ number_format($detalle->precio, 2) }}"
            cantidad="{{ number_format($detalle->cantidad, 2) }}"
            subtotal="{{ number_format($detalle->subtotal, 2) }}"
            fecha_compra="{{ $compra->created_at->format('d/m/Y') }}"
        />
    @endforeach
@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

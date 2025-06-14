@extends('layouts.panelAdmin')

@section('title', 'Gestión de Compras')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Compras',
        'subtitulo' => 'Lista de Compras.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.compras.header_tabla />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.compras.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($compras as $compra)
                            <x-gestion.compras.fila_tabla 
                               id_compra="{{ $compra->id_compra }}"
                                 nombre_proveedor="{{ $compra->proveedor->nombreC_proveedor ?? 'Sin proveedor' }}"
                                total_compra="{{ number_format($compra->total_compra, 2) }}"
                                  fecha_compra="{{ $compra->created_at->format('d/m/Y') }}"
                                  />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

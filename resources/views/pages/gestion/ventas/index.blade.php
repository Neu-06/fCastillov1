@extends('layouts.panelAdmin')

@section('title', 'Gestión de Usuarios')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Ventas',
        'subtitulo' => 'Lista de Ventas.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.ventas.header_tabla/>

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.ventas.nombre_columna/>

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($ventas as $venta)
                            <x-gestion.ventas.fila_tabla 
                                 id_venta="{{ $venta->id_venta }}"
                                 nombre_usuario="{{ $venta->usuario->nombre_usuario ?? 'Sin usuario' }}"
                                 nombre_cliente="{{ $venta->cliente->nombre_cliente ?? 'Sin cliente' }}"
                                 total_venta="{{ number_format($venta->total_venta, 2) }}"
                                  fecha_venta="{{ $venta->created_at->format('d/m/Y') }}"
                                  />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

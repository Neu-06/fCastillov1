@extends('layouts.panelAdmin')

@section('title', 'Gestión de Productos')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Productos',
        'subtitulo' => 'Lista de Productos.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

              <x-gestion.productos.header_tabla :eliminados="$eliminados ?? false" />


            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.productos.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($productos as $producto)
                            <x-gestion.productos.fila_tabla 
                            :codigo_producto="$producto->codigo_producto" 
                            :nombre_producto="$producto->nombre_producto" 
                            :descripcion_producto="$producto->detalle?->descripcion ?? 'Sin descripción'"
                            :categoria="$producto->categoria? $producto->categoria->nombre_categoria: 'Sin categoría'" 
                            :marca="$producto->detalle?->marca?->nombre_marca ?? 'Sin Marca'"
                            :id_producto="$producto->id_producto"
                            :eliminados="$eliminados ?? false" />
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

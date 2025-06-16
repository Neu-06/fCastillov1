@extends('layouts.panelAdmin')

@section('title', 'Gestión de Productos')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Productos',
        'subtitulo' => 'Lista de Productos.',
    ])

    <div class="mt-6">

                <!-- Filtro por Categoría -->
        <form method="GET" action="{{ route('producto.index') }}" class="mx-4 mt-4">
            <label for="categoria" class="font-semibold text-slate-700 mr-2">Filtrar por Categoría:</label>
            <select name="categoria_id" id="categoria" onchange="this.form.submit()"
                class="border border-gray-300 rounded px-2 py-1">
                <option value="">   Todas las Categorías   </option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}"
                        {{ request('categoria_id') == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre_categoria }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="table-container">

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
                            :descripcion_producto="$producto->descripcion ?? 'Sin descripción'"
                            :categoria="$producto->categoria? $producto->categoria->nombre_categoria: 'Sin categoría'" 
                            :marca="$producto->marca?->nombre_marca ?? 'Sin Marca'"
                            :id_producto="$producto->id_producto"
                            :eliminados="$eliminados ?? false" />
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

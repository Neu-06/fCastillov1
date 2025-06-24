@extends('layouts.panelAdmin')

@section('title', 'Gestión de Productos')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Productos',
        'subtitulo' => 'Lista de Productos.',
    ])

    <div class="mt-6">

        <!-- Filtro por Categoría -->
        <form method="GET" action="{{ route('producto.index') }}" class="mx-4 mt-6">
            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-4 items-start sm:items-end">
                <!-- Buscador -->
                <div>
                    <label for="busqueda" class="block text-sm font-semibold text-slate-700 mb-1">Buscar producto:</label>
                    <input type="text" name="busqueda" id="busqueda" value="{{ request('busqueda') }}"
                        placeholder="Nombre o código"
                        class="border border-gray-300 rounded px-3 py-1.5 w-[220px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Filtro categoría -->
                <div>
                    <label for="categoria" class="block text-sm font-semibold text-slate-700 mb-1">Filtrar por
                        Categoría:</label>
                    <select name="categoria_id" id="categoria"
                        class="border border-gray-300 rounded px-3 py-1.5 w-[220px] focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todas las Categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}"
                                {{ request('categoria_id') == $categoria->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón buscar -->
                <div class="pt-1 sm:pt-0">
                    <button type="submit" class="btn btn-primary h-10 px-6">
                         Buscar
                    </button>
                </div>
            </div>
        </form>


        <div class="table-container">

            <x-gestion.productos.header_tabla :eliminados="$eliminados ?? false" />


            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.productos.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($productos as $producto)
                            <x-gestion.productos.fila_tabla :codigo_producto="$producto->codigo_producto" :nombre_producto="$producto->nombre_producto" :descripcion_producto="$producto->descripcion ?? 'Sin descripción'"
                                :categoria="$producto->categoria
                                    ? $producto->categoria->nombre_categoria
                                    : 'Sin categoría'" :marca="$producto->marca?->nombre_marca ?? 'Sin Marca'" :estante="$producto->estante?->nombre_estante ?? 'Sin Estante'" :id_producto="$producto->id_producto" :eliminados="$eliminados ?? false" />
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 px-4 pb-6">
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

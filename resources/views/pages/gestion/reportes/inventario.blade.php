@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Reportes de Inventario',
        'subtitulo' => 'Reporte detallado de inventario de productos.',
    ])

    <div class="p-4 sm:p-6 lg:p-8">
        <form method="GET" class="mb-6 bg-white p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Categoría -->
            <div>
                <label for="categoria_id" class="block text-sm font-semibold text-gray-700 mb-1">Categoría</label>
                <select name="categoria_id" id="categoria_id"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 rounded-md shadow-sm text-sm">
                    <option value="">Todas</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}"
                            {{ request('categoria_id') == $categoria->id_categoria ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Área -->
            <div>
                <label for="area_id" class="block text-sm font-semibold text-gray-700 mb-1">Área</label>
                <select name="area_id" id="area_id"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 rounded-md shadow-sm text-sm">
                    <option value="">Todas</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id_area }}" {{ request('area_id') == $area->id_area ? 'selected' : '' }}>
                            {{ $area->nombre_area }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Marca -->
            <div>
                <label for="marca_id" class="block text-sm font-semibold text-gray-700 mb-1">Marca</label>
                <select name="marca_id" id="marca_id"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 rounded-md shadow-sm text-sm">
                    <option value="">Todas</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id_marca }}"
                            {{ request('marca_id') == $marca->id_marca ? 'selected' : '' }}>
                            {{ $marca->nombre_marca }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Stock mínimo -->
            <div>
                <label for="stock_min" class="block text-sm font-semibold text-gray-700 mb-1">Stock mínimo</label>
                <input type="number" name="stock_min" id="stock_min" min="0"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 rounded-md shadow-sm text-sm"
                    placeholder="Ej: 5" value="{{ request('stock_min') }}">
            </div>
            <!-- Botones -->
            <div class="md:col-span-4 flex justify-end gap-3 mt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md shadow text-sm">
                    Generar Reporte
                </button>
                <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->all(), ['pdf' => 1])) }}"
                    target="_blank"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-md shadow text-sm">
                    Exportar PDF
                </a>

                <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->all(), ['word' => 1])) }}"
                    target="_blank"
                    class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-5 py-2 rounded-md shadow text-sm">
                    Exportar Word
                </a>                
                <button type="submit" name="excel" value="1"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-md shadow text-sm">
                    Exportar Excel
                </button>
            </div>
        </form>
        <div class="overflow-auto rounded-lg shadow-md">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-200 text-xs uppercase tracking-wider text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">Código</th>
                        <th class="px-4 py-3 text-left">Nombre</th>
                        <th class="px-4 py-3 text-left">Descripcion</th>
                        <th class="px-4 py-3 text-left">Categoría</th>
                        <th class="px-4 py-3 text-center">Entradas</th>
                        <th class="px-4 py-3 text-center">Salidas</th>
                        <th class="px-4 py-3 text-center">Bajas</th>
                        <th class="px-4 py-3 text-center">Stock</th>
                        <th class="px-4 py-3 text-left">Ubicacion de Existencias</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($productos as $p)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $p['codigo'] }}</td>
                            <td class="px-4 py-2">{{ $p['nombre'] }}</td>
                            <td class="px-4 py-2">{{ $p['descripcion'] }}</td>
                            <td class="px-4 py-2">{{ $p['categoria'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $p['entradas'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $p['salidas'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $p['bajas'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $p['stock'] }}</td>
                            <td class="px-4 py-2">{{ $p['ubicacion_existencias'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Reportes de Inventario',
        'subtitulo' => '📦Reporte detallado de inventario de productos.',
    ])

    <div class="p-4 sm:p-6 lg:p-8">
        <form method="GET" class="mb-6 bg-white p-4 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="fecha_desde" class="block text-sm font-medium text-gray-700">Desde fecha</label>
                <input type="date" name="fecha_desde" id="fecha_desde" value="{{ request('fecha_desde') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="fecha_hasta" class="block text-sm font-medium text-gray-700">Hasta fecha</label>
                <input type="date" name="fecha_hasta" id="fecha_hasta" value="{{ request('fecha_hasta') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="md:col-span-4 flex justify-end space-x-2">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md shadow">
                    Generar Reporte
                </button>
                <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->all(), ['pdf' => 1])) }}"
                   target="_blank"
                   class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-md shadow">
                    Exportar PDF
                </a>
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

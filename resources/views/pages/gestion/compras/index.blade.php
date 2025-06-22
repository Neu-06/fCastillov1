@extends('layouts.panelAdmin')

@section('title', 'Gestión de Compras')

@section('contenido')

@include('components.panelAdmin.header', [
'titulo' => 'Gestionar Compras',
'subtitulo' => 'Lista de Compras.',
])

<div class="mt-6">
    <!-- Filtro por Proveedor -->
    <form method="GET" action="{{ route('compra.index') }}" class="mx-4 mt-4">
        <label for="Proveedor" class="font-semibold text-slate-700 mr-2">Filtrar por Proveedor:</label>
        <select name="proveedor_id" id="proveedor" onchange="this.form.submit()"
            class="border border-gray-300 rounded px-2 py-1">
            <option value=""> Todos los Proveedores </option>
            @foreach ($Proveedores as $proveedor)
            <option value="{{ $proveedor->id_proveedor }}"
                {{ request('proveedor_id') == $proveedor->id_proveedor ? 'selected' : '' }}>
                {{ $proveedor->nombreC_proveedor }}
            </option>
            @endforeach
        </select>

        {{-- Filtro por Fechas --}}
        <label for="fecha_inicio" class="font-semibold text-slate-700">Desde:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio"
            value="{{ request('fecha_inicio') }}"
            class="border border-gray-300 rounded px-2 py-1">

        <label for="fecha_fin" class="font-semibold text-slate-700">Hasta:</label>
        <input type="date" name="fecha_fin" id="fecha_fin"
            value="{{ request('fecha_fin') }}"
            class="border border-gray-300 rounded px-2 py-1">

        <button type="submit"
            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
            Filtrar
        </button>
    </form>
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
                <div class="mt-6 px-4 pb-6">
                    {{ $compras->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
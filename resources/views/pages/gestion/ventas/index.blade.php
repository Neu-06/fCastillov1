@extends('layouts.panelAdmin')

@section('title', 'Gestión de Usuarios')

@section('contenido')

@include('components.panelAdmin.header', [
'titulo' => 'Gestionar Ventas',
'subtitulo' => 'Lista de Ventas.',
])

<div class="mt-6">
    <!-- Filtro por Cliente -->
    <form method="GET" action="{{ route('venta.index') }}" class="mx-4 mt-4">
        <label for="Cliente" class="font-semibold text-slate-700 mr-2">Filtrar por Cliente:</label>
        <select name="cliente_id" id="cliente" onchange="this.form.submit()"
            class="border border-gray-300 rounded px-2 py-1">
            <option value=""> Todos los Clientes </option>
            @foreach ($Clientes as $cliente)
            <option value="{{ $cliente->id_cliente }}"
                {{ request('cliente_id') == $cliente->id_cliente ? 'selected' : '' }}>
                {{ $cliente->nombre_cliente }}
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

        <x-gestion.ventas.header_tabla />

        <!-- Tabla de usuarios -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left">

                <x-gestion.ventas.nombre_columna />

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
                <div class="mt-6 px-4 pb-6">
                    {{ $ventas->links() }}
                </div>
            </div>
        </div>
    </div>
    
@endsection
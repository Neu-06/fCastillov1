@extends('layouts.panelAdmin')

@section('title', 'Gestión de Marcas')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Marcas',
        'subtitulo' => 'Administración de Marcas del sistema.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.marcas.header_tabla />

            <!-- Tabla de marcas-->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.marcas.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($marcas as $marca)
                            <x-gestion.marcas.fila_tabla 
                                id_marca="{{ $marca->id_marca }}"
                                nombre_marca="{{ $marca->nombre_marca }}" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

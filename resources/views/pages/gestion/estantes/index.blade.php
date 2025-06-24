@extends('layouts.panelAdmin')

@section('title', 'Gestión de Estantes')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Estantes',
        'subtitulo' => 'Administración de Estantes del sistema.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.estantes.header_tabla />

            <!-- Tabla de estantes-->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.estantes.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($estantes as $estante)
                            <x-gestion.estantes.fila_tabla 
                                id_estante="{{ $estante->id_estante }}"
                                nombre_estante="{{ $estante->nombre_estante }}" />
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 px-4 pb-6">
                    {{ $estantes->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

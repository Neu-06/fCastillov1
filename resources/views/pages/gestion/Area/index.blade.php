@extends('layouts.panelAdmin')

@section('title', 'Gestión de Areas')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Areas',
        'subtitulo' => 'Administración de Areas del sistema.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.Areas.header_tabla />

            <!-- Tabla de areas-->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.Areas.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($Areas as $Area)
                            <x-gestion.Areas.fila_tabla 
                                id_area="{{ $Area->id_area }}"
                                nombre_area="{{ $Area->nombre_area }}" />
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-6 px-4 pb-6">
                {{ $Areas->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection

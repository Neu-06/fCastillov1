@extends('layouts.panelAdmin')

@section('title', 'Gestión de Categorías')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Categorías',
        'subtitulo' => 'Administración de categorías del sistema.',
    ])

    <div class="mt-6">

        <div class="table-container">

            <x-gestion.categorias.header_tabla />

            <!-- Tabla de categorías -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.categorias.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($categorias as $categoria)
                            <x-gestion.categorias.fila_tabla 
                                id_categoria="{{ $categoria->id_categoria }}"
                                nombre_categoria="{{ $categoria->nombre_categoria }}" />
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 px-4 pb-6">
                    {{ $categorias->links() }}
                </div>    
            </div>
        </div>
    </div>

@endsection

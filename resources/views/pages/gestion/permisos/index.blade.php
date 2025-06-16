@extends('layouts.panelAdmin')

@section('title', 'Gestión de Usuarios')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Permisos',
        'subtitulo' => 'Administración de permisos del sistema.',
    ])

    <div class="mt-6">

        <div class="table-container">

            <x-gestion.permisos.header_tabla />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.permisos.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($permisos as $permiso)
                            <x-gestion.permisos.fila_tabla
                                :id_permiso="$permiso->id_permiso"
                                :nombre_permiso="$permiso->nombre_permiso"
                            />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

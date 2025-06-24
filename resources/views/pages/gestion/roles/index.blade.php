@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Roles',
        'subtitulo' => 'Administración de Roles del sistema.',
    ])
    <!-- ENVOLTORIO Alpine.js -->
    <div class="mt-6">

        <div class="table-container">

            <x-gestion.roles.header_tabla />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.roles.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($roles as $rol)
                            <x-gestion.roles.fila_tabla :id_rol="$rol->id_rol" :nombre_rol="$rol->nombre_rol" />
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 px-4 pb-6">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>



    </div>



@endsection

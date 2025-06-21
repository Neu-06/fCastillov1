@extends('layouts.panelAdmin')

@section('title', 'Gestión de Usuarios')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Usuarios',
        'subtitulo' => 'Administración de usuarios del sistema.',
    ])

    <div class="mt-6">

        <div class="table-container">

            <x-gestion.usuarios.header_tabla :eliminados="$eliminados"  />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.usuarios.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($usuarios as $usuario)
                            <x-gestion.usuarios.fila_tabla nombre_usuario="{{ $usuario->nombre_usuario }}"
                                correo_usuario="{{ $usuario->correo_usuario }}"
                                nombre_rol="{{ $usuario->rol->nombre_rol ?? 'Sin rol' }}"
                                fecha_creacion="{{ $usuario->created_at->format('d/m/Y') }}"
                                estado="{{ $usuario->deleted_at ? 'Inactivo' : 'Activo' }}"
                                id_usuario="{{ $usuario->id_usuario }}" />
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 px-4 pb-6">
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

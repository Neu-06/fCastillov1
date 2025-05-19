@extends('layouts.panelAdmin')

@section('title', 'Gestión de Usuarios')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestionar Proveedores',
        'subtitulo' => 'Lista de proveedores.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.proveedores.header_tabla :eliminados="$eliminados" />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.proveedores.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($proveedores as $proveedor)
                            <x-gestion.proveedores.fila_tabla 
                                nombreC_proveedor="{{ $proveedor->nombreC_proveedor }}"
                                correo_proveedor="{{ $proveedor->correo_proveedor }}"
                                direccion_proveedor="{{ $proveedor->direccion_proveedor }}"
                                telefono_proveedor="{{ $proveedor->telefono_proveedor }}"
                                fecha_creacion="{{ $proveedor->created_at->format('d/m/Y') }}"
                                estado="{{ $proveedor->deleted_at ? 'Inactivo' : 'Activo' }}"
                                id_proveedor="{{ $proveedor->id_proveedor }}" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

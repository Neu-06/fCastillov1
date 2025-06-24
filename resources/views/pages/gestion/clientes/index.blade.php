@extends('layouts.panelAdmin')

@section('title', 'Gestión de Usuarios')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Clientes',
        'subtitulo' => 'Administración de clientes del sistema.',
    ])

    <div class="mt-6">

        <div class="table-container">

            <x-gestion.clientes.header_tabla :eliminados="$eliminados"  />

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.clientes.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($clientes as $cliente)
                            <x-gestion.clientes.fila_tabla
                                nombre_cliente="{{ $cliente->nombre_cliente }}"
                                apellido_cliente="{{ $cliente->apellido_cliente }}"
                                correo_cliente="{{ $cliente->correo_cliente }}"
                                telefono_cliente="{{ $cliente->telefono_cliente ?? 'Sin Telefono'  }}"
                                direccion_cliente="{{ $cliente->direccion_cliente ?? 'Sin Direccion' }}"
                                fecha_creacion="{{ $cliente->created_at->format('d/m/Y') }}"
                                estado="{{ $cliente->deleted_at ? 'Inactivo' : 'Activo' }}"
                                id_cliente="{{ $cliente->id_cliente }}"
                            />
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 px-4 pb-6">
                    {{ $clientes->links() }}
                </div>    
            </div>
        </div>
    </div>
@endsection

@extends('layouts.panelAdmin')

@section('title', 'Gestión de Bitacoras')

@section('contenido')

    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Bitacora',
        'subtitulo' => 'Administración de Bitacora.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <x-gestion.bitacoras.header_tabla :usuarios="$usuarios" />

            <!-- Tabla de categorías -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.bitacoras.nombre_columna />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($bitacoras as $bitacora)
                            <x-gestion.bitacoras.fila_tabla 
                                accion="{{ $bitacora->accion }}"
                                descripcion="{{ $bitacora->descripcion }}"
                                nombre_usuario="{{ $bitacora->nombre_usuario }}"
                                ip_origen="{{ $bitacora->ip_origen }}"
                                fecha_hora="{{ $bitacora->fecha_hora }}"
                            />
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 px-4 pb-6">
                    {{ $bitacoras->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection

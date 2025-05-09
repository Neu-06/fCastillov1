@extends('layouts.panelAdmin')

@section('title', 'Gestión de Usuarios')

@section('contenido')

    @include('components.header.headerAdmin', [
        'titulo' => 'Gestión de Usuarios',
        'subtitulo' => 'Administración de usuarios del sistema.',
    ])

    <div class="mt-6">

        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">

            <div class="flex items-center justify-between p-4 ">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Lista de usuario</h3>
                    <p class="text-slate-500">Revisar bien antes de editar.</p>
                </div>
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    <button
                        class="rounded border border-slate-300 py-2.5 px-3 text-center text-xs font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Ver Todos
                    </button>
                    <button
                        onclick="window.location.href='{{ route('vista.usuarioRegister') }}'"
                        class="flex select-none items-center gap-2 rounded bg-slate-800 py-2.5 px-4 text-xs font-semibold text-white shadow-md shadow-slate-900/10 transition-all hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                            stroke-width="2" class="w-4 h-4">
                            <path
                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                            </path>
                        </svg>
                        Agregar usuario
                    </button>
                </div>
            </div>

            <!-- Tabla de usuarios -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left">

                    <x-gestion.elementoTabla.nombreColumnaU />

                    <tbody class="text-gray-700 divide-y">
                        @foreach ($usuarios as $usuario)
                            <x-gestion.elementoTabla.filaGU nombre_usuario="{{ $usuario->nombre_usuario }}"
                                correo_usuario="{{ $usuario->correo_usuario }}"
                                nombre_rol="{{ $usuario->rol->nombre_rol ?? 'Sin rol' }}"
                                fecha_creacion="{{ $usuario->created_at->format('d/m/Y') }}"
                                estado="{{ $usuario->deleted_at ? 'Inactivo' : 'Activo' }}"
                                id_usuario="{{ $usuario->id_usuario }}" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endsection

@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Administracion de usuarios.'
  ])

  <main class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Gestión de Roles</h2>
        <a href="{{ route('roles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Nuevo Rol
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table class="min-w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Nombre del Rol</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $rol)
                    <tr class="border-b">
                        <td class="p-3">{{ $rol->id_rol }}</td>
                        <td class="p-3">{{ $rol->nombre_rol }}</td>
                        <td class="p-3">
                            <form action="{{ url('/admin/roles/' . $rol->id_rol) }}" method="POST" class="inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('¿Estás seguro?')">
                                       Eliminar
                                  </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

  @endsection
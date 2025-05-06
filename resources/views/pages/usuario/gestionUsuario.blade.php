@extends('layouts.admin')

@section('title', 'HomeAdministrador')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Administracion del sistema.'
  ])

  <div class="mt-6">
  <!-- Botón crear usuario -->
  <div class="mb-4">
    <a href="{{ route('vista.usuarioRegister') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
      + Nuevo Usuario
    </a>
  </div>

  <!-- Tabla de usuarios -->
  <div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full table-auto text-sm text-left">
      <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
        <tr>
          <th class="px-6 py-3">CI</th>
          <th class="px-6 py-3">Nombre</th>
          <th class="px-6 py-3">Correo</th>
          <th class="px-6 py-3">Estado</th>
          <th class="px-6 py-3">Rol</th>
          <th class="px-6 py-3 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-gray-700 divide-y">
        @foreach($usuarios as $usuario)
        <tr>
          <td class="px-6 py-4">{{ $usuario->ci }}</td>
          <td class="px-6 py-4">{{ $usuario->nombre }}</td>
          <td class="px-6 py-4">{{ $usuario->correo }}</td>
          <td class="px-6 py-4">{{ $usuario->estado }}</td>
          <td class="px-6 py-4">{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
          <td class="px-6 py-4 text-center">
          <a href="{{ route('usuario.edit', $usuario->ci) }}" class="text-blue-600 hover:underline mr-2">Editar</a>

            <form action="{{ route('usuario.destroy', $usuario->ci) }}"
                  method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection
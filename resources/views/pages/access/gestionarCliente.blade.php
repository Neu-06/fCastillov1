@extends('layouts.admin')

@section('title', 'HomeAdministrador')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Administracion del sistema.'
  ])
  <div class="mt-6">
  <!-- Botones de navegación -->
  <div class="mb-4 flex space-x-4">
    @if($estado === 'activo')
      <a href="{{ route('vista.clienteRegister') }}" 
         class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        + Nuevo Cliente
      </a>

      <a href="{{ route('administrador.gestionarCliente', ['estado' => 'inactivo']) }}"
         class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        Ver Clientes Inactivos
      </a>
    @else
      <a href="{{ route('administrador.gestionarCliente', ['estado' => 'activo']) }}"
         class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        Ver Clientes Activos
      </a>
    @endif
  </div>
  <!-- Tabla de usuarios -->
  <div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full table-auto text-sm text-left">
      <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
        <tr>
          <th class="px-6 py-3">CI</th>
          <th class="px-6 py-3">Nombre</th>
          <th class="px-6 py-3">Correo</th>
          <th class="px-6 py-3">Telefono</th>
          <th class="px-6 py-3">Direccion</th>
          <th class="px-6 py-3 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-gray-700 divide-y">
        @foreach($clientes as $cliente)
        <tr>
          <td class="px-6 py-4">{{ $cliente->ci }}</td>
          <td class="px-6 py-4">{{ $cliente->nombre }}</td>
          <td class="px-6 py-4">{{ $cliente->correo }}</td>
          <td class="px-6 py-4">{{ $cliente->telefono }}</td>
          <td class="px-6 py-4">{{ $cliente->direccion }}</td>
          <td class="px-6 py-4 text-center">
          <a href="{{ route('cliente.edit', $cliente->ci) }}" class="text-blue-600 hover:underline mr-2">Editar</a>

            <form action="{{ route('cliente.destroy', $cliente->ci) }}"
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
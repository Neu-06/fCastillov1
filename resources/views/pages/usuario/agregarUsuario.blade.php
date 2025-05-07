@extends('layouts.admin')

@section('title', 'HomeAdministrador')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Administracion de usuarios.'
  ])

  <main class="p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Registrar Nuevo Usuario</h2>
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <div class="mb-4 " >
                <label for="ci" class="block font-semibold mb-1">CI</label>
                <input type="text" id="ci" name="ci" required class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="nombre" class="block font-semibold mb-1">Nombre</label>
                <input type="text" id="nombre" name="nombre" required class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="correo" class="block font-semibold mb-1">Correo</label>
                <input type="email" id="correo" name="correo" required class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="contrasena" class="block font-semibold mb-1">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="id_rol" class="block font-semibold mb-1">Rol</label>
                <select id="id_rol" name="id_rol" required class="w-full border-gray-300 rounded-md p-2">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Registrar Usuario
            </button>
        </form>
    </div>
</main>
@endsection
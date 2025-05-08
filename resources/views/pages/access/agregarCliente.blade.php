@extends('layouts.admin')

@section('title', 'HomeAdministrador')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Administracion de usuarios.'
  ])

  <main class="p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Registrar Nuevo Cliente</h2>
        <form action="{{ route('clientes.stores') }}" method="POST">
            @csrf

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
                <label for="telefono" class="block font-semibold mb-1">Telefono</label>
                <input type="text" id="telefono" name="telefono" required class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="direccion" class="block font-semibold mb-1">Direccion</label>
                <input type="text" id="direccion" name="direccion" required class="w-full border-gray-300 rounded-md p-2">
            </div>
            

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Registrar Cliente
            </button>
        </form>
    </div>
</main>
@endsection
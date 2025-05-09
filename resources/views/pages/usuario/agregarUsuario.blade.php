@extends('layouts.panelAdmin')

@section('title', 'Registrar Usuario')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Administración de usuarios.',
])

<main class="p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Registrar Nuevo Usuario</h2>
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="nombre_usuario" class="block font-semibold mb-1">Nombre</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required
                    class="w-full border-gray-300 rounded-md p-2" placeholder="Ingrese el nombre del usuario">
            </div>

            <!-- Correo -->
            <div class="mb-4">
                <label for="correo_usuario" class="block font-semibold mb-1">Correo</label>
                <input type="email" id="correo_usuario" name="correo_usuario" required
                    class="w-full border-gray-300 rounded-md p-2" placeholder="Ingrese el correo electrónico">
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password_usuario" class="block font-semibold mb-1">Contraseña</label>
                <input type="password" id="password_usuario" name="password_usuario" required
                    class="w-full border-gray-300 rounded-md p-2" placeholder="Ingrese la contraseña">
            </div>

            <!-- Rol -->
            <div class="mb-4">
                <label for="id_rol" class="block font-semibold mb-1">Rol</label>
                <select id="id_rol" name="id_rol" required class="w-full border-gray-300 rounded-md p-2">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                    <option value="{{ $rol->id_rol }}">{{ $rol->nombre_rol }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Registrar Usuario
            </button>
        </form>
    </div>
</main>
@endsection
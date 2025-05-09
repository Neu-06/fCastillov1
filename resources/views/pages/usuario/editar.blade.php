@extends('layouts.panelAdmin')

@section('title', 'Editar Usuario')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Editar Usuario',
    'subtitulo' => 'Modifica la información del usuario.'
])

<main class="max-w-xl mx-auto mt-6 bg-white p-6 rounded-lg shadow">
    <form action="{{ route('usuario.update', $usuario->ci) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="ci" class="block font-semibold mb-1">CI</label>
            <input type="text" name="ci" id="ci" value="{{ old('ci', $usuario->ci) }}" readonly
                class="w-full border-gray-300 rounded-md p-2 bg-gray-100" />
        </div>

        <div class="mb-4">
            <label for="nombre" class="block font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}"
                class="w-full border-gray-300 rounded-md p-2" required />
        </div>

        <div class="mb-4">
            <label for="correo" class="block font-semibold mb-1">Correo</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo', $usuario->correo) }}"
                class="w-full border-gray-300 rounded-md p-2" required />
        </div>

        <div class="mb-4">
            <label for="estado" class="block font-semibold mb-1">estado</label>
            <input type="boolean" name="estado" id="estado" value="{{ old('estado', $usuario->estado) }}"
                class="w-full border-gray-300 rounded-md p-2" required />
        </div>

        <div class="mb-4">
            <label for="id_rol" class="block font-semibold mb-1">Rol</label>
            <select id="id_rol" name="id_rol" required class="w-full border-gray-300 rounded-md p-2">
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $usuario->id_rol == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                Actualizar Usuario
            </button>
            <a href="{{ route('vista.administrador.home') }}"
               class="ml-4 text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
</main>
@endsection

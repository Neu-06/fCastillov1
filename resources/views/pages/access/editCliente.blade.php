@extends('layouts.admin')

@section('title', 'Editar Cliente')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Editar Cliente',
    'subtitulo' => 'Modifica la información del cliente.'
])

<main class="max-w-xl mx-auto mt-6 bg-white p-6 rounded-lg shadow">
    <form action="{{ route('cliente.update', $cliente->ci) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="ci" class="block font-semibold mb-1">CI</label>
            <input type="text" name="ci" id="ci" value="{{ old('ci', $cliente->ci) }}" readonly
                class="w-full border-gray-300 rounded-md p-2 bg-gray-100" />
        </div>

        <div class="mb-4">
            <label for="nombre" class="block font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}"
                class="w-full border-gray-300 rounded-md p-2" required />
        </div>

        <div class="mb-4">
            <label for="correo" class="block font-semibold mb-1">Correo</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo', $cliente->correo) }}"
                class="w-full border-gray-300 rounded-md p-2" required />
        </div>

        <div class="mb-4">
    <label for="estado" class="block font-semibold mb-1">Estado</label>
    <select name="estado" id="estado" class="w-full border-gray-300 rounded-md p-2">
        <option value="1" {{ old('estado', $cliente->estado) == 1 ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ old('estado', $cliente->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
    </select>
</div>

        <div class="mb-4">
            <label for="telefono" class="block font-semibold mb-1">Telefono</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                class="w-full border-gray-300 rounded-md p-2" required />
        </div>

        <div class="mb-4">
            <label for="direccion" class="block font-semibold mb-1">Direccion</label>
            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}"
                class="w-full border-gray-300 rounded-md p-2" required />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                Actualizar Cliente
            </button>
            <a href="{{ route('administrador.gestionarCliente') }}"
               class="ml-4 text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
</main>
@endsection

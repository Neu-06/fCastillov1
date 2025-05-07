@extends('layouts.admin')

@section('title', 'Editar Proveedor')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Editar Proveedor',
    'subtitulo' => 'Modificar datos del proveedor seleccionado.'
])
@if (session('success'))
<div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow">
    {{ session('success') }}
</div>
@endif

<div class="mt-6 max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('proveedor.update', $proveedor->id_proveedor) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $proveedor->telefono) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email', $proveedor->email) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $proveedor->direccion) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex justify-end space-x-4 pt-4 border-t">
                <a href="{{ route('proveedor.index') }}" class="text-gray-500 hover:text-gray-700">Cancelar</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 shadow">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

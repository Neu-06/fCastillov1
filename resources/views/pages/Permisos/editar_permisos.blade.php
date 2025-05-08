@extends('layouts.admin') <!-- Asegúrate de usar tu layout principal -->
@section('title', 'Asignar Permisos')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Asignación de permisos al rol'
])
<main class="p-6">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Asignar Permisos al Rol: <span class="text-blue-600">{{ $rol->nombre }}</span>
        </h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('rol.permisos.actualizar', $rol->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                @foreach($permisos as $permiso)
                    <div class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            id="permiso_{{ $permiso->id_permiso }}"
                            name="permisos[]"
                            value="{{ $permiso->id_permiso }}"
                            class="h-5 w-5 text-blue-600 rounded border-gray-300"
                            {{ $rol->permisos->contains('id_permiso', $permiso->id_permiso) ? 'checked' : '' }}
                        >
                        <label for="permiso_{{ $permiso->id_permiso }}" class="text-gray-700 font-medium">
                            {{ $permiso->descripcion }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end space-x-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    Guardar cambios
                </button>
                <a href="{{ url()->previous() }}" class="text-gray-600 hover:underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</main>
@endsection

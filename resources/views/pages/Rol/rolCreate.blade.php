@extends('layouts.admin')

@section('title', 'HomeAdministrador')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Panel Admin',
    'subtitulo' => 'Administracion de usuarios.'
  ])

  <main class="p-6">
    <h2 class="text-xl font-bold mb-4">Registrar Nuevo Rol</h2>

    @if (session('success'))
        <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST" class="bg-white shadow-md rounded px-8 py-6">
        @csrf

        <div class="mb-4">
            <label for="nombre" class="block font-semibold mb-1">Nombre del Rol</label>
            <input type="text" name="nombre" id="nombre" required
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Registrar Rol</button>
    </form>
</main>

  @endsection
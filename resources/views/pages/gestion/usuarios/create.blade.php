@extends('layouts.panelAdmin')

@section('title', 'Registrar Usuario')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Panel Admin',
        'subtitulo' => 'Administración de usuarios.',
    ])


    @can('create', App\Models\Usuario::class)
        <x-gestion.usuarios.create :roles="$roles"/>
    @else
        <div class="text-red-600 text-center mt-8 font-semibold">
            No tienes permiso para registrar nuevos usuarios.
        </div>
    @endcan

@endsection

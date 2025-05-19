@extends('layouts.panelAdmin')

@section('title', 'Editar Usuario')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Editar Usuario',
        'subtitulo' => 'Modifica la información del usuario.',
    ])

    <x-gestion.usuarios.edit :usuario="$usuario" :roles="$roles" />
@endsection

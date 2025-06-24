@extends('layouts.panelAdmin')

@section('title', 'Editar Rol')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Editar Rol',
        'subtitulo' => 'Modifica la información del rol y sus permisos.',
    ])

    <x-gestion.roles.edit :rol="$rol" :permisos="$permisos" :casosDeUso="$casosDeUso" />
@endsection


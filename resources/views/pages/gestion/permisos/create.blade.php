@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Roles',
        'subtitulo' => 'Administración de Roles del sistema.',
    ])


    <x-gestion.permisos.create />


@endsection

@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Roles',
        'subtitulo' => 'Administración de Roles del sistema.',
    ])


       {{-- Aquí se invoca el componente --}}
    <x-gestion.roles.create :permisos="$permisos" :casosDeUso="$casosDeUso" />


@endsection

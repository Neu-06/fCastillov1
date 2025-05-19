@extends('layouts.panelAdmin')

@section('title', 'Registrar Usuario')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Panel Admin',
        'subtitulo' => 'Administración de usuarios.',
    ])

    <x-gestion.proveedores.create/>

@endsection

@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Marcas',
        'subtitulo' => 'Administración de Marcas de productos.',
    ])


    <x-gestion.marcas.create />


@endsection

@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Categorias',
        'subtitulo' => 'Administración de Categorias de productos.',
    ])


    <x-gestion.categorias.create />


@endsection

@extends('layouts.panelAdmin')

@section('title', 'Registrar Usuario')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Panel Admin',
        'subtitulo' => 'Administración de Productos.',
    ])

    <x-gestion.productos.create :categorias="$categorias" :marcas="$marcas"/>

@endsection

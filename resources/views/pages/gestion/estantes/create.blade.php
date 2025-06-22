@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Estantes',
        'subtitulo' => 'Administración de Estantes.',
    ])


    <x-gestion.estantes.create :Areas="$Areas"/>

@endsection

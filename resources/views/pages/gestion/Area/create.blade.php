@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Areas',
        'subtitulo' => 'Administración de Areas de Estante.',
    ])


    <x-gestion.Areas.create />


@endsection

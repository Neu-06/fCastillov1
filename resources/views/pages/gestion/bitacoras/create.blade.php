@extends('layouts.panelAdmin')

@section('title', 'HomeAdministrador')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Bitacora',
        'subtitulo' => 'Administración de Bitacora.',
    ])

@endsection

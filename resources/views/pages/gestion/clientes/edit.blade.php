@extends('layouts.panelAdmin')

@section('title', 'Editar Usuario')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Editar Proveedor',
        'subtitulo' => 'Modifica la información del proveedor.',
    ])

    <x-gestion.clientes.edit :cliente="$cliente"/>
@endsection

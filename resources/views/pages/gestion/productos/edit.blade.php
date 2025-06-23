@extends('layouts.panelAdmin')

@section('title', 'Editar Usuario')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Editar Producto',
        'subtitulo' => 'Modifica la información del producto.',
    ])

    <x-gestion.productos.edit :producto="$producto" :categorias="$categorias" :marcas="$marcas" :estantes="$estantes"/>
@endsection

@push('scripts')
    @vite('resources/js/producto-edit.js')
@endpush

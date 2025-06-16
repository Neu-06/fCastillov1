@extends('layouts.panelAdmin')

@section('title', 'Gestionar Precios')

@section('contenido')

<h1 class="text-2xl font-bold mb-4">Precios y Stock</h1>



@php
    $hayStockBajo = $productos->contains(function ($producto) {
        return $producto->stock <= 10;
    });
@endphp

@if($hayStockBajo)
    <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded text-sm">
        ⚠️ Hay productos con bajo stock. Revise el Stock Disponible.
    </div>
@endif


<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-300">
        <thead>
            @include('components.gestion.gestion-precios.header_tabla')
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                @include('components.gestion.gestion-precios.fila_tabla', ['producto' => $producto])
            @endforeach
        </tbody>
    </table>
</div>

@endsection


@extends('layouts.plantillaHome')

@section('title', $categoria->nombre_categoria)

@section('content')
<div class="container mx-auto py-8">
   <!-- Enlace de volver a categorías -->
    <div class="mb-4">
        <a href="{{ route('index') }}" class="text-gray-600 hover:underline flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Inicio
        </a>
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Categorías</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        @foreach($categorias as $categoria)
            <a href="{{ route('categoria.show', $categoria->id_categoria) }}"
               class="bg-white border-2 border-gray-300 rounded-xl shadow hover:shadow-xl transition-all duration-300 p-4 w-56 h-56 mx-auto flex flex-col justify-center items-center hover:border-gray-500">
                
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-gray-200 mb-3">
                    <img src="{{ asset('imagenes/' . $categoria->imagen) }}"
                         alt="{{ $categoria->nombre_categoria }}"
                         class="w-full h-full object-cover">
                </div>
                
                <div class="font-semibold text-md text-gray-800 text-center">
                    {{ $categoria->nombre_categoria }}
                </div>
            </a>
        @endforeach
    </div>



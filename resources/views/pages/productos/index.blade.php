@extends('layouts.plantillaHome')

@section('title', $categoria->nombre_categoria)

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Productos en {{ $categoria->nombre_categoria }}</h2>

        @if ($categoria->productos->isEmpty())
            <p class="text-gray-500">No hay productos en esta categoría.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categoria->productos as $producto)
                    <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                        @php
                            $imagen = optional($producto->imagenes->first())->ruta_imagen;
                        @endphp
                        <img src="{{ $imagen ?? asset('imagenes/default.jpg') }}" alt="{{ $producto->nombre_producto }}"class="w-full h-40 object-contain mb-2">
                        <h3 class="font-semibold text-sm">{{ $producto->nombre_producto }}</h3>
                        <p class="text-sm text-gray-600">Bs {{ $producto->precio_venta }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

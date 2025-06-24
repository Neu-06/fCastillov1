@extends('layouts.panelAdmin')

@section('title', 'Detalle de Producto')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Información de producto',
        'subtitulo' => $producto->nombre_producto,
    ])
    <div class="min-h-screen px-6 py-8 max-w-7xl mx-auto">



        <div class="card lg:card-side bg-base-100 shadow-sm border">
            {{-- Galería o imagen principal --}}
            <figure class="w-full lg:w-1/2 h-[400px] overflow-hidden">

                @if ($producto->imagenes->isNotEmpty())
                    <div class="carousel w-full">
                        @foreach ($producto->imagenes as $index => $imagen)
                            @php
                                // transformar la URL original de Cloudinary para estandarizar tamaño
                                $url = preg_replace(
                                    '/upload/',
                                    'upload/c_pad,w_600,h_400,b_white',
                                    $imagen->ruta_imagen,
                                );
                            @endphp

                            <div id="slide{{ $index }}"
                                class="carousel-item relative w-full h-[400px] flex items-center justify-center">
                                <img src="{{ $url }}"
                                    class="max-h-[400px] max-w-full object-contain rounded shadow" />

                                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                    <a href="#slide{{ $index === 0 ? $producto->imagenes->count() - 1 : $index - 1 }}"
                                        class="btn btn-circle">❮</a>
                                    <a href="#slide{{ $index === $producto->imagenes->count() - 1 ? 0 : $index + 1 }}"
                                        class="btn btn-circle">❯</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('imagenes/default.jpg') }}" alt="Imagen no disponible"
                        class="w-full h-[400px] object-contain" />
                @endif
            </figure>

  {{-- Detalles del producto --}}
<div class="card-body w-full lg:w-1/2 flex flex-col justify-between min-h-[400px]">
    {{-- Contenido del producto --}}
    <div class="flex flex-col justify-center h-full">
        {{-- Título del producto --}}
        <h2 class="text-2xl font-bold border-b pb-3 mb-4">{{ $producto->nombre_producto }}</h2>

        {{-- Grilla de campos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm text-slate-800">
            <div class="flex items-start gap-2">
                <i class="fa-solid fa-barcode mt-1 text-slate-500"></i>
                <p><strong>Código:</strong> {{ $producto->codigo_producto }}</p>
            </div>
            <div class="flex items-start gap-2">
                <i class="fa-solid fa-dollar-sign mt-1 text-slate-500"></i>
                <p><strong>Precio:</strong> Bs {{ number_format($producto->precio_venta, 2) }}</p>
            </div>

            <div class="flex items-start gap-2">
                <i class="fa-solid fa-box mt-1 text-slate-500"></i>
                <p><strong>Stock:</strong> {{ $producto->stock }}</p>
            </div>
            <div class="flex items-start gap-2">
                <i class="fa-solid fa-tags mt-1 text-slate-500"></i>
                <p><strong>Categoría:</strong> {{ $producto->categoria->nombre_categoria ?? 'Sin categoría' }}</p>
            </div>

            <div class="flex items-start gap-2">
                <i class="fa-solid fa-industry mt-1 text-slate-500"></i>
                <p><strong>Marca:</strong> {{ $producto->marca->nombre_marca ?? 'Sin marca' }}</p>
            </div>
            <div class="flex items-start gap-2">
                <i class="fa-solid fa-warehouse mt-1 text-slate-500"></i>
                <p><strong>Estante:</strong> {{ $producto->estante->nombre_estante ?? 'Sin estante' }}</p>
            </div>

            <div class="flex items-start gap-2 sm:col-span-2">
                <i class="fa-solid fa-align-left mt-1 text-slate-500"></i>
                <p><strong>Descripción:</strong> {{ $producto->descripcion ?? 'Sin descripción' }}</p>
            </div>
        </div>
    </div>

    {{-- Botón al fondo --}}
    <div class="card-actions justify-end mt-6">
        <a href="{{ route('producto.index') }}" class="btn btn-primary">← Regresar</a>
    </div>
</div>



        </div>
    </div>
    @push('scripts')
        <script>
            document.querySelectorAll('.carousel a.btn-circle').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const target = document.querySelector(btn.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    }
                });
            });
        </script>
    @endpush

@endsection

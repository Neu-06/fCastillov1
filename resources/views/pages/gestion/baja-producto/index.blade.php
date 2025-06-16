@extends('layouts.panelAdmin')

@section('title', 'Gestionar Baja de Producto')

@section('contenido')

    {{-- Título general --}}
    @include('components.gestion.baja-producto.nombre_columna')

    {{-- Mensaje de éxito si lo hay --}}
    @if (session('success'))
    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('success-message');
            if (msg) {
                msg.style.transition = 'opacity 0.5s ease';
                msg.style.opacity = 0;
                setTimeout(() => msg.remove(), 500); // lo remueve tras desvanecerlo
            }
        }, 4000); // 4000 ms = 4 segundos
    </script>
@endif

    {{-- Mostrar bajas realizadas --}}
    @if (!empty($mostrarBajas))
        <h3 class="text-base font-semibold text-gray-700 mb-2">Historial de bajas realizadas</h3>

        <table class="w-full text-sm text-left">
            <thead>
                @include('components.gestion.baja-producto.header_tabla')
            </thead>
            <tbody>
                @foreach ($bajas as $baja)
                    @include('components.gestion.baja-producto.fila_tabla', ['baja' => $baja, 'mostrarBajas' => true])
                @endforeach
            </tbody>
        </table>

    {{-- Mostrar productos disponibles --}}
    @else
        <h3 class="text-base font-semibold text-gray-700 mb-2">Datos de los productos disponibles</h3>

        <table class="w-full text-sm text-left">
            <thead>
                @include('components.gestion.baja-producto.header_tabla')
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    @include('components.gestion.baja-producto.fila_tabla', ['producto' => $producto])
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

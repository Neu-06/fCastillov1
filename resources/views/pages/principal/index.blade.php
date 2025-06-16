@extends('layouts.plantillaHome')

@section('title', 'Home')

@section('content')
    <!-- CARRUSEL SOLAMENTE -->
    <div x-data="carousel()" x-init="startAutoplay()" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
        class="relative w-full overflow-hidden shadow-md">

        <div class="flex transition-transform duration-700" :style="`transform: translateX(-${currentIndex * 100}%);`">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="w-full flex-shrink-0">
                    <img :src="slide" class="w-full h-[200px] md:h-[250px] lg:h-[400px] object-cover"
                        alt="Promoción" />
                </div>
            </template>
        </div>

        <!-- Flechas dentro del contenedor del carrusel -->
        <button x-show="slides.length > 1" @click="prev()"
            class="absolute top-1/2 left-4 transform -translate-y-1/2 text-white text-3xl font-bold hover:text-blue-300">
            &#10094;
        </button>
        <button x-show="slides.length > 1" @click="next()"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 text-white text-3xl font-bold hover:text-blue-300">
            &#10095;
        </button>
    </div>
    <!-- CARRUSEL DE TARJETAS EN MÓVIL -->
    <div x-data="{ pagoOpen: false, ubicacionOpen: false, envioOpen: false }" class="relative -mt-10 md:hidden">
        <!-- Corte justo al ancho de una tarjeta -->
        <div class="overflow-x-auto scrollbar-hide w-[270px] mx-auto">
            <div class="flex gap-4 w-max">

                <!-- TARJETA 1 - Entrega -->
                <div @click="envioOpen = true"
                    class="w-[270px] h-[70px] 	bg-blue-300 text-black rounded-2xl px-4 py-2 text-center shadow-md cursor-pointer shrink-0 flex flex-col items-center justify-center">
                    <div class="text-lg mb-0.5">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3 class="font-bold text-xs leading-none">¿Cómo entregan mi pedido?</h3>
                    <p class="text-[10px] leading-none">Envíos a domicilio</p>
                </div>

                <!-- TARJETA 2 - Ubicación -->
                <div @click="ubicacionOpen = true"
                    class="w-[270px] h-[70px] bg-blue-300 text-black rounded-2xl px-4 py-2 text-center shadow-md cursor-pointer shrink-0 flex flex-col items-center justify-center">
                    <div class="text-lg mb-0.5">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="font-bold text-xs leading-none">¿Dónde están ubicados?</h3>
                    <p class="text-[10px] leading-none">Atención de lunes a sábado</p>
                </div>

                <!-- TARJETA 3 - Pago -->
                <div @click="pagoOpen = true"
                    class="w-[270px] h-[70px] bg-blue-300 text-black rounded-2xl px-4 py-2 text-center shadow-md cursor-pointer shrink-0 flex flex-col items-center justify-center">
                    <div class="text-lg mb-0.5">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3 class="font-bold text-xs leading-none">¿Cómo se paga la compra?</h3>
                    <p class="text-[10px] leading-none">Formas y métodos de pago</p>
                </div>

            </div>
        </div>
    </div>
    <!-- CATEGORÍAS PARA MÓVIL -->
   <div class="md:hidden px-4 mt-6">
    <div class="bg-[#004876] text-white text-center font-bold shadow-md rounded-md px-4 py-2 mb-4">
        <h2 class="text-base sm:text-lg">Nuestras Categorías</h2>
    </div>

        <div class="flex overflow-x-auto gap-4 pb-2 scrollbar-hide">
            @foreach ($categorias as $categoria)
                @php
                    $producto = $categoria->productos->first();
                    $imagen = $producto?->imagenes->first()?->ruta_imagen ?? asset('imagenes/default.jpg');
                @endphp

                <a href="{{ route('categoria.productos', $categoria->id_categoria) }}"
                    class="flex-shrink-0 w-[140px] bg-white rounded-xl shadow-md p-2 text-center">
                    <img src="{{ $imagen }}" alt="{{ $categoria->nombre_categoria }}"
                        class="w-full h-[90px] object-contain mb-2" />
                    <div class="text-sm font-medium truncate">{{ $categoria->nombre_categoria }}</div>
                    <div class="text-xs text-gray-500">({{ $categoria->productos_count ?? $categoria->productos->count() }})
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <!-- SCRIPT del CARRUSEL -->
    <script>
        function carousel() {
            return {
                currentIndex: 0,
                slides: [
                    "{{ asset('imagenes/carusel1.jpg') }}",
                    "{{ asset('imagenes/carusel2.jpg') }}",
                ],
                autoplayInterval: null,
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.slides.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
                },
                goTo(index) {
                    this.currentIndex = index;
                },
                startAutoplay() {
                    if (this.slides.length <= 1) return;
                    this.autoplayInterval = setInterval(() => this.next(), 4000);
                },
                stopAutoplay() {
                    clearInterval(this.autoplayInterval);
                }
            };
        }
    </script>
    <!-- PUNTITOS SOLO EN DESKTOP, BIEN CENTRADOS Y SEPARADOS -->
    <div x-show="slides.length > 1" class="hidden md:flex justify-center pt-6 pb-4 space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <div @click="goTo(index)" class="w-2.5 h-2.5 rounded-full cursor-pointer transition duration-300"
                :class="currentIndex === index ? 'bg-black' : 'bg-gray-300'"></div>
        </template>
    </div>
    <!-- CONTENEDOR SOLO PARA DESKTOP -->
    <div class="hidden md:flex flex-col items-center gap-6 py-4 -mt-6">
        <!-- TARJETAS -->
        <div class="flex justify-center gap-8">

            <!-- TARJETA 1 -->
            <div @click="ubicacionOpen = true"
                class="w-[300px] h-[110px] bg-white border border-black rounded-xl px-6 py-4 text-center shadow-sm cursor-pointer hover:shadow-md transition">
                <div class="text-2xl mb-2"><i class="fas fa-map-marker-alt"></i></div>
                <h3 class="font-bold text-sm">Como retirar en sucursal?</h3>
                <p class="text-sm text-gray-700">Retirás en el día</p>
            </div>

            <!-- TARJETA 2 -->
            <div @click="pagoOpen = true"
                class="w-[300px] h-[110px] bg-white border border-black rounded-xl px-6 py-4 text-center shadow-sm cursor-pointer hover:shadow-md transition">
                <div class="text-2xl mb-2"><i class="fas fa-credit-card"></i></div>
                <h3 class="font-bold text-sm">Como se paga la compra?</h3>
                <p class="text-sm text-gray-700">Formas y métodos de pago</p>
            </div>

            <!-- TARJETA 3 -->
            <div @click="envioOpen = true"
                class="w-[300px] h-[110px] bg-white border border-black rounded-xl px-6 py-4 text-center shadow-sm cursor-pointer hover:shadow-md transition">
                <div class="text-2xl mb-2"><i class="fas fa-truck"></i></div>
                <h3 class="font-bold text-sm">Como entregan mi pedido?</h3>
                <p class="text-sm text-gray-700">Envíos a domicilio</p>
            </div>
        </div>

        <section class="bg-fondoSuave">
            <div class="max-w-[1600px] w-full px-4 sm:px-6 lg:px-10 mx-auto">

                <!-- Banner Título -->
              <div class="bg-[#004876] text-white text-base sm:text-lg font-bold py-2 px-6 text-center shadow-md mb-6 rounded-full w-full max-w-[1200px] mx-auto">
                    <h2 class="text-white text-base sm:text-lg font-bold">Nuestras Categorías</h2>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 text-center">
                    @foreach ($categorias as $categoria)
    @php
        $producto = $categoria->productos->first();
        $imagen = $producto?->imagenes->first()?->ruta_imagen;
    @endphp

    @if ($producto && $imagen)
        <a
            href="{{ route('categoria.productos', $categoria->id_categoria) }}"
            class="flex flex-col items-center justify-between bg-white p-4 rounded-xl shadow-sm hover:scale-105 transition h-[250px]">

            <div class="mt-4 flex items-center justify-center h-[140px] w-full">
                <img src="{{ $imagen }}" alt="{{ $categoria->nombre_categoria }}"
                    class="h-[150px] w-[150px] object-contain" />
            </div>

            <div class="mt-auto">
                <span class="font-semibold text-sm sm:text-base text-gray-700 block">
                    {{ $categoria->nombre_categoria }}
                </span>
                <span class="text-xs text-gray-500 block">
                    ({{ $categoria->productos_count ?? $categoria->productos->count() }})
                </span>
            </div>
        </a>
    @endif
@endforeach
                </div>
            </div>
        </section>





    @endsection

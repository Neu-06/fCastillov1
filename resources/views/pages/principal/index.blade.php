@extends('layouts.plantillaHome')

@section('title', 'Home')

@section('content')
<div 
    x-data="carousel()" 
    x-init="startAutoplay()" 
    @mouseenter="stopAutoplay()" 
    @mouseleave="startAutoplay()"
    class="relative w-full overflow-hidden rounded-none shadow-md">
    <!-- Slides -->
    <div class="flex transition-transform duration-700"
         :style="`transform: translateX(-${currentIndex * 100}%);`">
        <template x-for="(slide, index) in slides" :key="index">
            <div class="w-full flex-shrink-0">
                <img :src="slide" class="w-full h-[200px] md:h-[250px] lg:h-[400px] object-cover" alt="Promoción" />
            </div>
        </template>
    </div>
    <!-- Flechas -->
    <button 
        x-show="slides.length > 1"
        @click="prev()" 
        class="absolute top-1/2 left-4 transform -translate-y-1/2 text-white text-3xl font-bold hover:text-blue-300"
    >&#10094;</button>

    <button 
        x-show="slides.length > 1"
        @click="next()" 
        class="absolute top-1/2 right-4 transform -translate-y-1/2 text-white text-3xl font-bold hover:text-blue-300"
    >&#10095;</button>

    <!-- Puntitos -->
    <div x-show="slides.length > 1" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                @click="goTo(index)"
                class="w-3 h-3 rounded-full cursor-pointer"
                :class="currentIndex === index ? 'bg-blue-600' : 'bg-gray-300'"
            ></div>
        </template>
    </div>
</div>
<!-- Script separado -->
<script>
    function carousel() {
        return {
            currentIndex: 0,
            slides: [
                "{{ asset('imagenes/carusel1.jpg') }}",
                "{{ asset('imagenes/carusel2.jpg') }}",
                // "{{ asset('imagenes/carusel3.png') }}",
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
                if(this.slides.length <= 1) return;
                this.autoplayInterval = setInterval(() => {
                    this.next();
                }, 4000);
            },
            stopAutoplay() {
                clearInterval(this.autoplayInterval);
            }
        }
    }
</script>
<div class="container mx-auto py-8 px-4 sm:px-0">
    <h2 class="text-2xl font-bold mb-6 text-center">CATEGORÍAS DESTACADAS</h2>

    <div class="w-full overflow-x-auto scroll-smooth">
        <div class="flex flex-nowrap gap-2 py-6 px-2 sm:px-0 scroll-snap-x snap-x snap-mandatory sm:justify-center">
            @foreach ($categorias as $categoria)
                <div class="flex-shrink-0 flex flex-col items-center snap-start 
                            w-[33.33%] sm:w-28 md:w-32 lg:w-36 xl:w-40">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-amber-500 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('storage/categorias/' . $categoria->imagen) }}"
                             alt="{{ $categoria->nombre_categoria }}"
                             class="w-20 h-20 sm:w-28 sm:h-28 object-cover rounded-full border-4 border-white">
                    </div>
                        <span class="mt-2 text-center text-sm sm:text-lg font-extrabold text-black uppercase tracking-wide">
                        {{ $categoria->nombre_categoria }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

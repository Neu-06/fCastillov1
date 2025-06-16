<header class="sticky top-0 z-50 bg-white">
    {{-- Desktop: Topbar --}}
    <div id="topbar"
        class="hidden md:block overflow-hidden transition-[max-height] duration-300 ease-in-out bg-white border-b border-gray-300"
        style="max-height: 40px;">
        <x-header.navs.top-bar />
    </div>

    {{-- Desktop: Logo, buscador, carrito --}}
    <div class="hidden md:flex items-center justify-center gap-12 px-0 py-0 bg-white w-full">
        <a href="/" class="flex items-center">
            <img src="{{ asset('imagenes/LOGO_FERRETERIA1.png') }}" alt="Logo" class="h-24 object-contain" />
        </a>
        <div class="w-full max-w-4xl mx-4">
            <x-header.buscador />
        </div>
        <a href="/carrito" class="flex items-center gap-2 text-gray-800 relative hover:text-blue-700 transition">
            <i class="fas fa-shopping-cart text-4xl"></i>
            <span class="text-sm font-semibold">Bs.0</span>
            <span
                class="absolute -top-1 -right-2 text-[10px] font-bold bg-red-500 text-white w-4 h-4 flex items-center justify-center rounded-full">
                {{ session('cart_count', 0) }}
            </span>
        </a>
    </div>

    {{-- Desktop: Menú de navegación --}}
    <div class="hidden md:block">
        @include('components.header.navs.navMenu')
    </div>

    {{-- Móvil: Encabezado compacto --}}
    <div class="md:hidden bg-white px-4 py-2 flex justify-between items-center border-b border-gray-200">
        <x-header.navs.navM />
        <a href="/" class="flex justify-center">
            <img src="{{ asset('imagenes/LOGO_FERRETERIA1.png') }}" alt="Logo" class="h-8 object-contain" />
        </a>
        <div class="flex items-center space-x-4 text-gray-700">
            <a href="#" class="text-xl"><i class="fas fa-search"></i></a>
            <a href="{{ route('login') }}" class="text-xl"><i class="fas fa-user"></i></a>
            <a href="/carrito" class="relative text-xl">
                <i class="fas fa-shopping-cart"></i>
                <span
                    class="absolute -top-1 -right-2 text-[10px] font-bold bg-red-500 text-white w-4 h-4 flex items-center justify-center rounded-full">
                    {{ session('cart_count', 0) }}
                </span>
            </a>
        </div>
    </div>
</header>

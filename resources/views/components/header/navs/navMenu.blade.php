<nav class="bg-navBlue text-white shadow-md w-full z-40 sticky top-0 min-h-[50px]">
    <div class="max-w-7xl mx-auto px-4">
        <ul class="flex items-center space-x-2 text-[17px] font-semibold">
            <!-- INICIO -->
            <li>
                <a href="{{ route('index') }}"
                    class="px-4 py-3 {{ request()->is('/') ? 'bg-navOrange text-white' : 'hover:bg-white hover:text-navBlue' }} transition rounded-t">
                    Inicio
                </a>
            </li>

            <!-- PRODUCTOS (MEGA MENÚ) -->
            <li x-data="{ open: false }" class="relative group">
                <button @mouseenter="open = true" @mouseleave="open = false" class="px-4 py-3 transition"
                    :class="open ? 'bg-white text-navBlue' : 'group-hover:bg-white group-hover:text-navBlue'">
                    Productos ▾
                </button>

                <div x-show="open" x-transition @mouseenter="open = true" @mouseleave="open = false"
                    class="absolute left-0 w-[90vw] max-w-6xl bg-white text-black mt-1 rounded shadow-lg z-50 p-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 text-sm">

                    @foreach ($categorias as $categoria)
                        <div>
                            <h3 class="font-bold text-navBlue mb-2 capitalize">{{ $categoria->nombre_categoria }}</h3>
                            @foreach ($categoria->productos as $producto)
                                <a href="{{ route('producto.show', $producto->id_producto) }}"
                                    class="block hover:underline text-sm lowercase">
                                    {{ $producto->nombre_producto }}
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </li>

            <!-- MARCAS -->
            <li x-data="{ open: false }" class="relative group">
                <button @mouseenter="open = true" @mouseleave="open = false" class="px-4 py-3 transition"
                    :class="open ? 'bg-white text-navBlue' : 'group-hover:bg-white group-hover:text-navBlue'">
                    Marcas ▾
                </button>

                <ul x-show="open" x-transition @mouseenter="open = true" @mouseleave="open = false"
                    class="absolute bg-white text-gray-800 mt-1 rounded shadow-md w-40 z-50">
                    @foreach ($marcas as $marca)
                        <li>
                            <a href="{{ route('marca.show', $marca->id_marca) }}"
                                class="block px-4 py-2 hover:bg-gray-100 truncate">
                                {{ $marca->nombre_marca }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <!-- EXTRAS -->
            <li>
                <a href="#" class="px-4 py-3 hover:bg-white hover:text-navBlue transition block">Cómo comprar</a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 hover:bg-white hover:text-navBlue transition block">Ofertas</a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 hover:bg-white hover:text-navBlue transition block">Contacto</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Menú hamburguesa móvil -->
<div x-data="{ isOpen: false }" class="flex md:hidden items-center">
    <button @click="isOpen = !isOpen" type="button"class="text-blue-900 hover:text-blue-600 focus:outline-none"
        aria-label="toggle menu">
        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
        </svg>
    </button>
    <!-- Menú lateral -->
    <div x-cloak x-show="isOpen"
        @click.away="isOpen = false":class="isOpen ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-full'"
        class="fixed h-screen top-0 left-0 w-64 z-50 px-6 pt-6 bg-white shadow-md transition-all duration-300 ease-in-out overflow-y-auto">

        <!-- Botón cerrar -->
        <button @click="isOpen = false" class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <nav class="flex flex-col space-y-3 text-sm font-medium text-gray-700">
            <a href="/" class="hover:text-blue-700">Inicio</a>

            <!-- Productos -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full">
                    <span>Productos</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-1" x-transition>
                    <a href="#" class="block hover:text-blue-600">Herramientas</a>
                    <a href="#" class="block hover:text-blue-600">Pinturas</a>
                    <a href="#" class="block hover:text-blue-600">Electricidad</a>
                </div>
            </div>

            <!-- Marcas -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full">
                    <span>Marcas</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-1" x-transition>
                    <a href="#" class="block hover:text-blue-600">Tramontina</a>
                    <a href="#" class="block hover:text-blue-600">Bosch</a>
                    <a href="#" class="block hover:text-blue-600">Stanley</a>
                </div>
            </div>

            <a href="#" class="hover:text-blue-700">Cómo comprar</a>
            <a href="#" class="hover:text-blue-700">Ofertas</a>
            <a href="#" class="hover:text-blue-700">Contacto</a>

            <!-- Divider -->
            <hr class="my-2">

            <!-- Mi cuenta -->
            <!--  <a href="/mi-cuenta" class="flex items-center gap-2 text-blue-700">
                <i class="fas fa-user"></i> Mi cuenta
            </a> -->

            <!-- Carrito -->
            <!--<a href="/carrito" class="flex items-center gap-2 text-gray-700">
                <i class="fas fa-shopping-cart"></i> Carrito (0) Bs.0
            </a>-->
        </nav>
    </div>
</div>

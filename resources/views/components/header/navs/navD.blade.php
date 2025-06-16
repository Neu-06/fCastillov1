<header class="w-full">

    <!-- Barra superior -->
    <div class="bg-white border-b text-sm text-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">

            <!-- Redes -->
            <div class="flex items-center gap-3">
                <a href="#" class="hover:text-blue-600 flex items-center gap-1">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <span>|</span>
                <a href="#" class="hover:text-pink-600 flex items-center gap-1">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                <span>|</span>
                <a href="#" class="hover:text-blue-800 flex items-center gap-1">
                    <i class="fab fa-linkedin-in"></i> LinkedIn
                </a>
            </div>

            <!-- Contacto -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <i class="fas fa-comment-dots"></i> Pedidos por Whatsapp
                </div>
                <span>|</span>
                <div class="flex items-center gap-1">
                    <i class="fas fa-envelope"></i> ferreteria@castillo.com
                </div>
                <span>|</span>
                <div class="flex items-center gap-1">
                    <i class="fas fa-phone"></i> 75612597
                </div>
                <span>|</span>
                <a href="/mi-cuenta" class="flex items-center gap-1 hover:text-blue-700">
                    <i class="fas fa-user"></i> Mi Cuenta
                </a>
            </div>
        </div>
    </div>

    <!-- Zona principal: Logo, buscador, carrito -->
    <div class="bg-white py-4 px-6 grid grid-cols-3 items-center gap-4 max-w-7xl mx-auto">

        <!-- Logo -->
        <a href="/" class="flex items-center">
            <img src="/ruta-del-logo.png" alt="Logo Ferretería Castillo" class="h-20 w-auto object-contain" />
        </a>

        <!-- Buscador -->
        <form action="/buscar" method="GET" class="w-full">
            <div class="flex border border-blue-900 rounded-full overflow-hidden shadow-sm">
                <input type="text" name="q" placeholder="Buscar"
                    class="px-4 py-2 w-full focus:outline-none text-sm text-gray-700" />
                <button type="submit" class="bg-blue-900 px-4 text-white flex items-center justify-center">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <!-- Mi cuenta + Carrito -->
        <!--  <div class="flex justify-end items-center gap-6">
            <a href="/mi-cuenta" class="text-blue-700 flex items-center gap-2 hover:underline">
                <i class="fas fa-user text-xl"></i> Mi cuenta
            </a>-->
        <a href="/carrito" class="relative text-gray-700 flex items-center gap-1 hover:text-blue-600">
            <i class="fas fa-shopping-cart text-xl"></i>
            <span class="text-sm">Bs. 0</span>
            <span
                class="absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">0</span>
        </a>
    </div>
    </div>

    <!-- Menú principal -->
    <nav class="bg-blue-900 text-white px-6 py-3">
        <ul class="flex gap-6 font-medium max-w-7xl mx-auto">
            <li><a href="/" class="hover:underline">Inicio</a></li>
            <li><a href="/productos" class="hover:underline">Productos</a></li>
            <li><a href="/marcas" class="hover:underline">Marcas</a></li>
            <li><a href="/como-comprar" class="hover:underline">Cómo comprar</a></li>
            <li><a href="/ofertas" class="hover:underline">Ofertas</a></li>
            <li><a href="/contacto" class="hover:underline">Contacto</a></li>
        </ul>
    </nav>
</header>

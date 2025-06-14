<nav class="bg-navBlue text-white shadow-md w-full z-40 sticky top-0">
  <div class=" max-w-7xl mx-auto px-4">
    <ul class="flex items-center space-x-2 text-sm font-semibold">
      <li class="px-4 py-3 bg-navOrange text-white rounded-t">Inicio</li>

      <li x-data="{ open: false }" class="relative group">
        <button @mouseenter="open = true" @mouseleave="open = false"
            class="px-4 py-3 group-hover:bg-white group-hover:text-navBlue transition">
          Productos ▾
        </button>

        <ul x-show="open" @mouseenter="open = true" @mouseleave="open = false"
            x-transition class="absolute bg-white text-gray-800 mt-1 rounded shadow-md w-56 z-50 p-4 grid grid-cols-2 gap-4 text-sm">

          <div>
            <h3 class="font-semibold text-navBlue mb-2">Herramientas</h3>
            <a href="/productos/herramientas/electricas" class="block hover:underline">Eléctricas</a>
            <a href="/productos/herramientas/manuales" class="block hover:underline">Manuales</a>
            <a href="/productos/herramientas/cajas" class="block hover:underline">Cajas y Herramientas</a>
          </div>

          <div>
            <h3 class="font-semibold text-navBlue mb-2">Iluminación</h3>
            <a href="/productos/iluminacion/focos" class="block hover:underline">Focos</a>
            <a href="/productos/iluminacion/led" class="block hover:underline">Tiras LED</a>
            <a href="/productos/iluminacion/paneles" class="block hover:underline">Paneles</a>
          </div>

        </ul>
      </li>

      <li x-data="{ open: false }" class="relative group">
        <button @mouseenter="open = true" @mouseleave="open = false"
            class="px-4 py-3 group-hover:bg-white group-hover:text-navBlue transition">
          Marcas ▾
        </button>
        <ul x-show="open" x-transition class="absolute bg-white text-gray-800 mt-1 rounded shadow-md w-40 z-50">
          <li class="px-4 py-2 hover:bg-gray-100">Tramontina</li>
          <li class="px-4 py-2 hover:bg-gray-100">Bosch</li>
          <li class="px-4 py-2 hover:bg-gray-100">Stanley</li>
        </ul>
      </li>

      <li class="px-4 py-3 hover:bg-white hover:text-navBlue transition">Cómo comprar</li>
      <li class="px-4 py-3 hover:bg-white hover:text-navBlue transition">Ofertas</li>
      <li class="px-4 py-3 hover:bg-white hover:text-navBlue transition">Contacto</li>
    </ul>
  </div>
</nav>
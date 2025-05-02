<!-- Mobile menu button -->
<div class="flex md:hidden">
    <button x-cloak @click="isOpen = !isOpen" type="button"
        class="text-tWhite hover:text-gray-600  focus:outline-none focus:text-gray-400" aria-label="toggle menu">
        <!--boton de abrir menu -->
        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
        </svg>


    </button>
</div>

<!-- navBar" -->
<div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']"
    class="absolute inset-x-0 w-52  p-3 z-10 px-6 top-0 transition-all duration-300 ease-in-out
     bg-NavBar2 md:bg-NavBar1 md:mt-0 md:p-0 md:top-0 md:relative md:bg-transparent
      md:w-auto md:right-0 md:opacity-100 md:translate-x-0 md:flex md:items-center">

    <div class="flex flex-col md:flex-row md:mx-6 w-auto">

        <!-- boton de ocultar menu-->
        <button class="flex md:hidden" x-cloak @click="isOpen = !isOpen" type="button"
            class="text-tWhite hover:text-gray-600  focus:outline-none focus:text-gray-400" aria-label="toggle menu">
            <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-tWhite" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>


        <a class="my-1 text-tWhite transition-colors duration-300 transform hover:text-tHoverNav md:mx-4 md:my-0"
            href="login">Iniciar Sesion
        </a>
        <a class="my-1 text-tWhite transition-colors duration-300 transform hover:text-tHoverNav md:mx-4 md:my-0"
            href="#">Cerrar Seccion
        </a>
    </div>

</div>

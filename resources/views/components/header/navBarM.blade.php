<!-- Mobile menu button -->
<div class="flex md:hidden">
    <button x-cloak @click="isOpen = !isOpen" type="button"
        class="text-tWhite hover:text-tBlack  focus:outline-none focus:text-gray-400" aria-label="toggle menu">
        <!--boton de abrir menu -->
        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
        </svg>
    </button>
</div>

<!-- navBar" -->
<div x-cloak x-show="isOpen" @click.away="isOpen = false"
    :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']"
    class="absolute h-screen inset-x-0 w-52 z-10 px-5 pt-2 top-0 transition-all duration-300 ease-in-out
     bg-NavBar2">

    <!-- boton de ocultar menu-->
    <button x-cloak @click="isOpen = !isOpen" type="button"
        class="flex text-tWhite hover:text-tBlack  focus:outline-none focus:text-gray-400" aria-label="toggle menu">
        <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-tWhite" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <x-header.navsM/>

</div>

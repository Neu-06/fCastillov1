<header x-data="{ isOpen: false }" class="relative  bg-NavBar1 ">
    <div class="px-6 py-2 mx-auto flex justify-between items-center md:flex md:align-baseline">
        <div class="md:hidden">
            <x-header.navBar />
        </div>

        <a class="text-2xl font-bold text-tWhite text-center md:order-1" href="#">
            Ferreteria Castillo
        </a>

        <div class="hidden md:flex md:flex-grow md:order-2">
            <x-header.buscador />
        </div>
    </div>

    <div class="hidden md:flex md:justify-center">
        <x-header.navBar/>
    </div>

    <div class="md:hidden">
        <x-header.buscador />
    </div>

</header>

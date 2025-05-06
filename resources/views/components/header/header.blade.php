<header x-data="{ isOpen: false }" class="relative  bg-NavBar1">

    {{-- orden movil --}}
    <div class="md:hidde">
        <div class="px-6 py-1 mx-auto flex justify-between items-center md:flex md:align-baseline">
            <div class="md:hidden">
                <x-header.navBarM />
            </div>

            <a class="text-2xl font-bold text-tWhite text-center md:hidden" href="/">
                Ferreteria Castillo
            </a>
        </div>

        <div class="md:hidden">
            <x-header.buscador />
        </div>
    </div>

    {{-- orden computer --}}
    <div class="hidden md:block md:align-baseline">
        <div class="md:px-6 py-1 mx-auto flex justify-between items-center md:flex md:align-baseline">

            <a class="text-2xl font-bold text-tWhite md:order-1 md:basis-52 lg:basis-60 justify-start" href="/">
                Ferreteria Castillo
            </a>

            <div class="hidden md:flex md:flex-grow md:order-2">
                <x-header.buscador />
            </div>

            <div class="hidden md:flex md:order-3 md:basis-38 lg:basis-44 justify-end pr-2">
                <x-header.accountD />
            </div>
        </div>

        <div class="hidden md:flex md:justify-center md:items-center">
            <x-header.navBarD />
        </div>

    </div>






</header>

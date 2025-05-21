<header x-data="{ isOpen: false }" class="sticky top-0 z-50  bg-NavBar1">

    {{-- orden movil --}}
    <div class="md:hidde">
        <div class="px-6 py-1 mx-auto flex justify-between items-center md:hidden md:align-baseline">
            <div>
                <x-header.navs.navM />
            </div>

            <a class="text-2xl font-bold text-tWhite text-center md:hidden" href="/">
                Ferreteria Castillo
            </a>

            <div>
                <x-access.logoutBtt/>
            </div>
            
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
                <x-access.logoutBtt/>
            </div>
        </div>

        <div class="hidden md:flex md:justify-center md:items-center">
            <x-header.navs.navD/>
        </div>

    </div>






</header>

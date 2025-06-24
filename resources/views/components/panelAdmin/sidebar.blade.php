<div x-data="{ isOpen: false }">

    <!-- Botón para desplegar el menú (visible solo en pantallas pequeñas) -->
    <div class="lg:hidden">
        <button @click="isOpen = !isOpen" type="button"
            class="text-tBlack hover:text-tBlack focus:outline-none focus:text-gray-400 p-4" aria-label="toggle menu">
            <!-- Icono de abrir menú -->
            <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside :class="{ 'translate-x-0': isOpen, '-translate-x-full': !isOpen }"
        class="fixed lg:translate-x-0 transform top-0 left-0 w-64 bg-white shadow-md h-screen border-r border-gray-200 transition-transform duration-300 ease-in-out z-50 flex flex-col justify-between">

        <!-- Contenido superior del sidebar -->
        <div class="flex flex-col h-full">
            <div class="p-6 font-bold text-xl border-b text-blue-600 flex justify-between items-center">
                Panel Admin
                <!-- Botón para cerrar el menú (visible solo en pantallas pequeñas) -->
                <button @click="isOpen = false" type="button" class="lg:hidden text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Menú scrollable -->
            <nav class="flex flex-col mt-4 gap-1 mx-4 overflow-y-auto" style="max-height: calc(100vh - 200px);">
                <!-- Inicio -->
                <a href="{{ route('admin.home') }}"
                    class="items-start rounded-lg  p-2 text-gray-900 font-semibold hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    Inicio
                </a>

                <!-- Opciones de gestión -->
                <x-header.elementosNav.optionNav texto="Gestionar" display="static">

                    @if (auth()->user()->tienePermiso('Ver Usuarios'))
                        <x-header.elementosNav.optionSecundario link="{{ route('usuario.index') }}"
                            texto="Gestionar Usuarios" />
                    @endif

                    @if (auth()->user()->tienePermiso('Ver Roles'))
                        <x-header.elementosNav.optionSecundario link="{{ route('rol.index') }}"
                            texto="Gestionar Roles" />
                    @endif

                    @if (auth()->user()->tienePermiso('Ver Bitacoras'))
                        <x-header.elementosNav.optionSecundario link="{{ route('bitacora.index') }}"
                            texto="Gestionar Bitacora" />
                    @endif

                    @if (auth()->user()->tienePermiso('Ver Permisos'))
                        <x-header.elementosNav.optionSecundario link="{{ route('permiso.index') }}"
                            texto="Gestionar Permiso" />
                    @endif

                </x-header.elementosNav.optionNav>

                <!-- Compras -->
                <x-header.elementosNav.optionNav texto="Compras" display="static">
                     @if (auth()->user()->tienePermiso('Ver Proveedores'))
                        <x-header.elementosNav.optionSecundario link="{{ route('proveedor.index') }}"
                            texto="Gestionar Proveedores" />
                    @endif
                    @if (auth()->user()->tienePermiso('Ver Compras'))
                        <x-header.elementosNav.optionSecundario link="{{ route('compra.index') }}"
                            texto="Gestionar Compras" />
                    @endif
                </x-header.elementosNav.optionNav>
                
                <!-- Ventas -->
                <x-header.elementosNav.optionNav texto="Ventas" display="static">
                    @if (auth()->user()->tienePermiso('Ver Clientes'))
                        <x-header.elementosNav.optionSecundario link="{{ route('cliente.index') }}"
                            texto="Gestionar Clientes" />
                    @endif

                    @if (auth()->user()->tienePermiso('Ver Ventas'))
                        <x-header.elementosNav.optionSecundario link="{{ route('venta.index') }}"
                            texto="Gestionar Ventas" />
                    @endif

                </x-header.elementosNav.optionNav>

                <!--Inventario -->
                <x-header.elementosNav.optionNav texto="Inventario" display="static">
                     {{-- @if (auth()->user()->tienePermiso('Ver Bitacora'))
                        <x-header.elementosNav.optionSecundario link="{{ route('bitacora.index') }}"
                            texto="Bitacora" />
                    @endif --}}
                    @if (auth()->user()->tienePermiso('Ver Productos'))
                        <x-header.elementosNav.optionSecundario link="{{ route('producto.index') }}"
                            texto="Gestionar Productos" />
                    @endif
                    @if (auth()->user()->tienePermiso('Ver Categorias'))
                        <x-header.elementosNav.optionSecundario link="{{ route('categoria.index') }}"
                            texto="Gestionar Categorias" />
                    @endif
                    @if (auth()->user()->tienePermiso('Ver Marcas'))
                        <x-header.elementosNav.optionSecundario link="{{ route('marca.index') }}"
                            texto="Gestionar Marcas" />
                    @endif                            {{-- Area --}}
                    @if (auth()->user()->tienePermiso('Ver Marcas'))
                        <x-header.elementosNav.optionSecundario link="{{ route('area.index') }}"
                            texto="Gestionar Areas" />
                    @endif

                     @if (auth()->user()->tienePermiso('Ver Marcas'))
                        <x-header.elementosNav.optionSecundario link="{{ route('estante.index') }}"
                            texto="Gestionar Estante" />
                    @endif

                     @if (auth()->user()->tienePermiso('Ver Marcas'))
                    <x-header.elementosNav.optionSecundario link="{{ route('gestionprecios.index') }}"
                     texto="Precios y Stock" />
                     @endif

                   @if (auth()->user()->tienePermiso('Ver Marcas'))
                        <x-header.elementosNav.optionSecundario link="{{ route('bajaproducto.index') }}"
                            texto="Bajas de Productos" />
                   @endif
                     @if (auth()->user()->tienePermiso('Ver Marcas'))
                        <x-header.elementosNav.optionSecundario link="{{ route('reporte.inventario') }}"
                            texto="Gestion Reportes de Inventario" />
                   @endif
                     

                </x-header.elementosNav.optionNav>
        
            </nav>
        </div>

        <!-- Botón de cerrar sesión SIEMPRE visible -->
        <div class="flex justify-center items-center mt-4 mb-4">
            <x-access.logoutBtt />
        </div>
    </aside>

    <!-- Fondo oscuro para cerrar el menú (solo en pantallas pequeñas) -->
    <div x-show="isOpen" @click="isOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-40 "></div>
</div>

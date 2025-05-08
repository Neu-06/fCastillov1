<aside class="w-64 bg-white shadow-md hidden md:block">
  <div class="p-6 font-bold text-xl border-b text-blue-600">Panel Admin</div>
  <nav class="p-4">
    <ul class="space-y-4 text-gray-700">
      <li><a href="{{ route('vista.administrador.home') }}" class="block hover:text-blue-500">Inicio</a></li>
      @if (auth()->check() && auth()->user()->tienePermiso('CU3: Gestionar usuarios'))

      <li><a href="{{ route('administrador.gestionarUsuario') }}">Gestión de Usuarios</a></li>
      @endif
      @if (auth()->check() && auth()->user()->tienePermiso('CU7: Gestionar proveedor'))

      <li><a href="{{ route('proveedor.index') }}">Gestión de Proveedores</a></li>
      @endif
      @if (auth()->check() && auth()->user()->tienePermiso('CU4: Asignar roles a usuarios'))
      <li><a href="{{ url('/admin/roles') }}" class="block hover:text-blue-500">Roles</a></li>
      @endif
      <li><a href="{{ url('/admin/ventas') }}" class="block hover:text-blue-500">Ventas</a></li>
      <li><a href="{{ url('/admin/inventario') }}" class="block hover:text-blue-500">Inventario</a></li>
      <li><a href="{{ url('/admin/productos') }}" class="block hover:text-blue-500">Productos</a></li>
      <li><a href="{{ url('/admin/reportes') }}" class="block hover:text-blue-500">Reportes</a></li>
      
       <!-- Cerrar sesión con formulario -->
    <li>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="text-red-500 hover:text-red-600 w-full text-left">
          Cerrar sesión
        </button>
      </form>
    </li>
     
    </ul>
  </nav>
</aside>

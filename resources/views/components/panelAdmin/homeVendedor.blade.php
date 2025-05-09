<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">
  @csrf
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md hidden md:block">
      <div class="p-6 font-bold text-xl border-b">Panel Vendedor</div>
      <nav class="p-4">
        <ul class="space-y-4 text-gray-700">
          <li><a href="#" class="block hover:text-blue-500">Inicio</a></li>
          <li><a href="#" class="block hover:text-blue-500">Mis Productos</a></li>
          <li><a href="#" class="block hover:text-blue-500">Ventas</a></li>
          <li><a href="#" class="block hover:text-blue-500">Inventario</a></li>
          <li><a href="#" class="block hover:text-blue-500">Perfil</a></li>
          
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

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Header -->
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">¡Bienvenido, Vendedor!</h1>
        <p class="text-gray-600">Aquí tienes un resumen de tu actividad.</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Ventas -->
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-gray-600 text-sm font-semibold">Ventas del Mes</h2>
          <p class="text-2xl font-bold text-blue-600 mt-2">$4,320</p>
        </div>

        <!-- Productos Activos -->
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-gray-600 text-sm font-semibold">Productos Activos</h2>
          <p class="text-2xl font-bold text-green-600 mt-2">24</p>
        </div>

        <!-- Bajo Stock -->
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-gray-600 text-sm font-semibold">Productos con Bajo Stock</h2>
          <p class="text-2xl font-bold text-red-500 mt-2">3</p>
        </div>
      </div>

      <!-- Tabla de Últimas Ventas -->
      <div class="mt-10 bg-white rounded-xl shadow-md p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Últimas Ventas</h2>
        <table class="min-w-full table-auto text-left">
          <thead>
            <tr class="text-sm text-gray-600 border-b">
              <th class="pb-2">Producto</th>
              <th class="pb-2">Fecha</th>
              <th class="pb-2">Cantidad</th>
              <th class="pb-2">Total</th>
            </tr>
          </thead>
          <tbody class="text-sm text-gray-700">
            <tr class="border-b">
              <td class="py-2">Cerveza Artesanal</td>
              <td>03/05/2025</td>
              <td>4</td>
              <td>$40</td>
            </tr>
            <tr class="border-b">
              <td class="py-2">Vino Tinto</td>
              <td>02/05/2025</td>
              <td>2</td>
              <td>$60</td>
            </tr>
            <tr>
              <td class="py-2">Whisky Premium</td>
              <td>01/05/2025</td>
              <td>1</td>
              <td>$120</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>

  </div>

</body>
</html>

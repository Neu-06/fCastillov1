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
      <div class="p-6 font-bold text-xl border-b text-blue-600">Panel Admin</div>
      <nav class="p-4">
        <ul class="space-y-4 text-gray-700">
          <li><a href="#" class="block hover:text-blue-500">Inicio</a></li>
          <li><a href="{{url('')}}" class="block hover:text-blue-500">Gestión de Usuarios</a></li>
          <li><a href="#" class="block hover:text-blue-500">Roles y Permisos</a></li>
          <li><a href="#" class="block hover:text-blue-500">Ventas</a></li>
          <li><a href="#" class="block hover:text-blue-500">Inventario</a></li>
          <li><a href="#" class="block hover:text-blue-500">Productos</a></li>
          <li><a href="#" class="block hover:text-blue-500">Reportes</a></li>
          <li><a href="#" class="block text-red-500 hover:text-red-600">Cerrar sesión</a></li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Header -->
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">¡Bienvenido, Administrador!</h1>
        <p class="text-gray-600">Controla y supervisa toda la plataforma.</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Ventas -->
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-gray-600 text-sm font-semibold">Ventas Totales</h2>
          <p class="text-2xl font-bold text-blue-600 mt-2">$12,450</p>
        </div>

        <!-- Usuarios registrados -->
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-gray-600 text-sm font-semibold">Usuarios Registrados</h2>
          <p class="text-2xl font-bold text-purple-600 mt-2">68</p>
        </div>

        <!-- Productos activos -->
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-gray-600 text-sm font-semibold">Productos Activos</h2>
          <p class="text-2xl font-bold text-green-600 mt-2">115</p>
        </div>

        <!-- Stock bajo -->
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-gray-600 text-sm font-semibold">Bajo Stock</h2>
          <p class="text-2xl font-bold text-red-500 mt-2">6</p>
        </div>
      </div>

      <!-- Tabla de Usuarios Recientes -->
      <div class="mt-10 bg-white rounded-xl shadow-md p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Usuarios Recientes</h2>
        <table class="min-w-full table-auto text-left">
          <thead>
            <tr class="text-sm text-gray-600 border-b">
              <th class="pb-2">Nombre</th>
              <th class="pb-2">Email</th>
              <th class="pb-2">Rol</th>
              <th class="pb-2">Fecha Registro</th>
            </tr>
          </thead>
          <tbody class="text-sm text-gray-700">
            <tr class="border-b">
              <td class="py-2">Ana Morales</td>
              <td>ana@example.com</td>
              <td>Vendedora</td>
              <td>04/05/2025</td>
            </tr>
            <tr class="border-b">
              <td class="py-2">Luis Gómez</td>
              <td>luis@example.com</td>
              <td>Cliente</td>
              <td>03/05/2025</td>
            </tr>
            <tr>
              <td class="py-2">Carlos Pérez</td>
              <td>carlos@example.com</td>
              <td>Administrador</td>
              <td>02/05/2025</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>

  </div>

</body>
</html>

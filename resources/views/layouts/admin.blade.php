<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Panel Admin')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">
    @include('components.dashboard.sidebarAdmin')

    <!-- Contenido principal -->
    <main class="flex-1 p-6">
      @yield('contenido')
    </main>
  </div>

</body>
</html>
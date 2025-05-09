<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite('resources/css/app.css')

    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="bg-gray-100 font-sans">

    <x-panelAdmin.sidebarAdmin/>

    <!-- Contenido principal -->
    <main class="p-6 flex-1 lg:ml-64 bg-gray-100">
      
        @yield('contenido')
    </main>


</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-yHqYw8uL70MSOJLMbj1IpWQd3KdPSLgWRPzyyZy1mN4cHgqt5MGs5PRAgHEVzT0p6XCTO8aBkAK6Dof2KQ+fgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('styles')
</head>

<body class="bg-gray-100 font-sans">
    @stack('scripts')
    <x-panelAdmin.sidebar />

    <!-- Contenido principal -->
    <main class="p-1 lg:p-6 flex-1 lg:ml-64 bg-gray-100">


        @yield('contenido')
    </main>
    <script src="{{ asset('js/producto-edit.js') }}"></script>
    @stack('scripts')


</body>


</html>

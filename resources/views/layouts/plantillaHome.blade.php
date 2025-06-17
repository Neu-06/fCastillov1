<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-yHqYw8uL70MSOJLMbj1IpWQd3KdPSLgWRPzyyZy1mN4cHgqt5MGs5PRAgHEVzT0p6XCTO8aBkAK6Dof2KQ+fgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite('resources/css/app.css')

    @vite('resources/js/app.js')

    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-200">
    <x-header.header />

    @yield('content')

</body>

</html>

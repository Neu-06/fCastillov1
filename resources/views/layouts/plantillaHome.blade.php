<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>


    @vite('resources/css/app.css')

    @vite('resources/js/app.js')

    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-200">
    <x-header.header/>
    
    @yield('content')
</body>

</html>

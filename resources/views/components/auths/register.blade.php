

<div class="h-auto flex justify-center mt-28">
    <div class="hidden lg:flex w-full lg:w-1/2 justify-around items-center bg-gray-600">
        <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
            <h1 class="text-white font-bold text-4xl font-sans">Ferreteria Castillo</h1>
            <p class="text-white mt-1">Todo lo que necesites para construir.</p>
        </div>
    </div>


    <div class="flex w-wLR">
        <div class="w-full">
        <form  action="{{ route('cliente.store') }}" method="POST" class="bg-orange-400 rounded-md shadow-2xl p-5">
    @csrf

    <h2 class="text-2xl font-semibold mb-6 text-center">Registro de Cliente</h2>

    <div class="mb-4">
        <label for="ci" class="block text-gray-700 font-medium mb-1">CI</label>
        <input type="text" name="ci" id="ci" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
    </div>

    <div class="mb-4">
        <label for="nombre" class="block text-gray-700 font-medium mb-1">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
    </div>

    <div class="mb-4">
        <label for="correo" class="block text-gray-700 font-medium mb-1">Correo</label>
        <input type="email" name="correo" id="correo" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
    </div>

    <div class="mb-4">
        <label for="contrasena" class="block text-gray-700 font-medium mb-1">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
    </div>

    <div class="mb-4">
        <label for="telefono" class="block text-gray-700 font-medium mb-1">Teléfono</label>
        <input type="text" name="telefono" id="telefono" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
    </div>

    <div class="mb-4">
        <label for="direccion" class="block text-gray-700 font-medium mb-1">Dirección</label>
        <input type="text" name="direccion" id="direccion" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
    </div>


    <div class="text-center">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">Registrarse</button>
    </div>
</form>

        </div>

    </div>
</div>

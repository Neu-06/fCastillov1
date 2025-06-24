<form action="{{ route('categoria.store') }}" method="POST" class="space-y-6">
    @csrf
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-sm mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-700 mb-4">Registrar Nueva Categoría</h1>
            <div>
                <label for="nombre_categoria" class="block mb-1 text-gray-600 font-semibold">Nombre de Categoría</label>
                <input type="text" name="nombre_categoria" id="nombre_categoria" required
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
        </div>
        <div class="flex justify-between mt-6">
            <button type="submit"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg font-bold shadow hover:bg-blue-700 transition">
                Registrar
            </button>
            <a href="{{ route('categoria.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                Cancelar
            </a>
        </div>
    </div>
</form>

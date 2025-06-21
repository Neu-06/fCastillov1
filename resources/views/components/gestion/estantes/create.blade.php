@props(['Areas'])
<form action="{{ route('estante.store') }}" method="POST" class="space-y-6">
    @csrf
    <div class="bg-white px-10 py-8 rounded-xl shadow-md max-w-sm mx-auto">
        <div class="space-y-4">
            <h1 class="text-center text-2xl font-semibold text-gray-700 mb-4">Registrar Nuevo Estante</h1>
            <div>
                <label for="nombre_area" class="block mb-1 text-gray-600 font-semibold">Nombre de Estante</label>
                <input type="text" name="nombre_estante" id="nombre_estante" required
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
            </div>
             <label for="id_area" class="block mb-1 text-gray-600 font-semibold">Area</label>
                <select name="id_area" id="id_area" required
                    class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    <option value="">Seleccione una Area</option>
                    @foreach ($Areas as $area)
                        <option value="{{ $area->id_area }}" {{ old('id_area') == $area->id_area ? 'selected' : '' }}>
                            {{ $area->nombre_area }}
                        </option>
                    @endforeach
                </select>
        </div>
        <div class="flex justify-between mt-6">
            <button type="submit"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg font-bold shadow hover:bg-blue-700 transition">
                Registrar
            </button>
            <a href="{{ route('estante.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition shadow">
                Cancelar
            </a>
        </div>
    </div>
</form>

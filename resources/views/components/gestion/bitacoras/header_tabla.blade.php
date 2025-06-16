<div class="flex items-center justify-between p-4 ">
    <div>
        <h3 class="text-lg font-semibold text-slate-800">Lista de Bitacora</h3>
    </div>
</div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('bitacora.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input type="text" name="usuario" value="{{ request('usuario') }}" placeholder="Filtrar por usuario"
            class="border border-gray-300 rounded p-2 w-full">
        <input type="text" name="fecha" value="{{ request('fecha') }}" placeholder="Ej: 24/05/2025"
            class="border border-gray-300 rounded p-2 w-full">
        <select name="tipo" class="border border-gray-300 rounded p-2 w-full">
            <option value=""> Tipo de acción </option>
            <option value="crear" {{ request('tipo') == 'CREAR' ? 'selected' : '' }}>Crear</option>
            <option value="actualizar" {{ request('tipo') == 'ACTUALIZAR' ? 'selected' : '' }}>Actualizar</option>
            <option value="eliminar" {{ request('tipo') == 'ELIMINAR' ? 'selected' : '' }}>Eliminar</option>
        </select>
        <button type="submit"
            class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition">Filtrar</button>
    </form>

@if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2 transition-all duration-500">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
        class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2 transition-all duration-500">
        {{ session('error') }}
    </div>
@endif

<div class="flex items-center justify-between p-4 ">
    <div>
        <h3 class="text-lg font-semibold text-slate-800">Lista de Bitacora</h3>
    </div>
</div>
<!-- Filtros -->
<form method="GET" action="{{ route('bitacora.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    
    {{-- Usuario --}}
    <input type="text" name="usuario" value="{{ request('usuario') }}" placeholder="Filtrar por usuario"
        class="rounded-md border border-gray-400 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm focus:border-slate-500 focus:outline-none focus:ring-1 focus:ring-slate-500 transition-all">

    {{-- Fecha --}}
    <input type="text" name="fecha" value="{{ request('fecha') }}" placeholder="Ej: 24/05/2025"
        class="rounded-md border border-gray-400 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm focus:border-slate-500 focus:outline-none focus:ring-1 focus:ring-slate-500 transition-all">

    {{-- Tipo de acción --}}
    <select name="tipo"
        class="rounded-md border border-gray-400 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm focus:border-slate-500 focus:outline-none focus:ring-1 focus:ring-slate-500 transition-all">
        <option value="">Tipo de acción</option>
        <option value="CREAR" {{ request('tipo') == 'CREAR' ? 'selected' : '' }}>CREAR</option>
        <option value="ACTUALIZAR" {{ request('tipo') == 'ACTUALIZAR' ? 'selected' : '' }}>ACTUALIZAR</option>
        <option value="ELIMINAR" {{ request('tipo') == 'ELIMINAR' ? 'selected' : '' }}>ELIMINAR</option>
    </select>

    {{-- IP --}}

    {{-- Botón Filtrar --}}
    <button type="submit"
        class="flex select-none items-center justify-center gap-2 rounded bg-slate-800 py-2.5 px-4 text-xs font-semibold text-white shadow-md shadow-slate-900/10 transition-all 
        hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] 
        active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
            <path
                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
            </path>
        </svg>
        Filtrar
    </button>
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

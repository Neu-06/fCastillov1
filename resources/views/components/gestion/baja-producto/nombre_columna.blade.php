<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Gestionar Baja de Productos</h2>
        <p class="text-sm text-gray-500">Revisá el stock antes de dar de baja productos defectuosos o dañados.</p>
    </div>
    <div class="flex space-x-2">
    
      <div class="flex justify-between items-center mb-4">

    <div class="flex gap-2">
        @if (!empty($mostrarBajas))
            {{-- SOLO cuando estás viendo el historial --}}
            <a href="{{ route('bajaproducto.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded text-sm hover:bg-gray-700 transition">
                ← Volver al listado
            </a>
        @else
            {{-- SOLO cuando estás en la vista principal --}}
            <a href="{{ route('bajaproducto.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
                + Registrar baja
            </a>
            <a href="{{ route('bajaproducto.realizadas') }}"
               class="bg-gray-200 text-gray-800 px-4 py-2 rounded text-sm hover:bg-gray-300 transition">
                📋 Ver bajas realizadas
            </a>
        @endif
    </div>
</div>


    </div>
</div>

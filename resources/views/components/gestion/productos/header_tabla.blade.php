@props(['eliminados' => false])

<div class="flex items-center justify-between p-4 ">
    <div>
        <h2 class="h2-global">Lista de Productos</h2>
        <p class="p-global">Revisar bien antes de editar.</p>
    </div>

    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
        <!-- Botón para alternar entre eliminados y activos -->
        @if ($eliminados)
            <a href="{{ route('producto.index') }}" class="btn-viewDeletes" type="button">
                Ver Activos
            </a>
        @else
            <a href="{{ route('producto.eliminados') }}" class="btn-viewDeletes" type="button">
                Ver Eliminados
            </a>
        @endif

        <!-- Botón Agregar -->
        @if (!isset($eliminados) || !$eliminados)
            @if (auth()->user()->tienePermiso('Agregar Productos'))
                <a href="{{ route('producto.create') }}" class="btn-create">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M12 4v16m8-8H4" />
                    </svg>
                    Agregar Productos
                </a>
            @endif
        @endif
    </div>
</div>

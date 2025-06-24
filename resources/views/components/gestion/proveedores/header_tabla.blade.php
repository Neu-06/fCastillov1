@props(['eliminados' => false])

<div class="flex items-center justify-between p-4 ">
    <div>
        <h2 class="h2-global">Lista de Proveedores</h2>
        <p class="p-global">Revisar bien antes de editar.</p>
    </div>
    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
        @if(auth()->user()->tienePermiso('Ver Proveedores'))
        @if ($eliminados)
            <a href="{{ route('proveedor.index') }}"
                class="btn-viewDeletes"
                type="button">
                Ver Activos
            </a>
        @else
            <a href="{{ route('proveedor.eliminados') }}"
                class="btn-viewDeletes"
                type="button">
                Ver Eliminados
            </a>
        @endif
        @endif

        {{-- Agregar Proveedor --}}
        @if(auth()->user()->tienePermiso('Agregar Proveedores'))
        <a href="{{ route('proveedor.create') }}"
            class="btn-create">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                stroke-width="2" class="w-4 h-4">
                <path
                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                </path>
            </svg>
            Agregar Proveedor
        </a>
        @endif
    </div>
</div>
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
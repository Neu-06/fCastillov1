@php
    $isCliente = auth('cliente')->check();
    $isUsuario = auth()->check();
@endphp

<div x-data="{ loggedOut: false, showModal: false }">
    @if ($isUsuario)
       <form action="{{ route('logout') }}" method="POST"
            @submit.prevent="
                fetch($el.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(() => { window.location.reload(); });
            ">
            @csrf
            <button type="submit"
                class="flex text-center text-white bg-red-500 py-2 px-4 rounded-md hover:bg-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                </svg>
                Cerrar sesión
            </button>
        </form>
    @elseif ($isCliente)
        <button type="button"
            class="flex text-white bg-red-500 py-2 px-4 rounded-md hover:bg-red-600"
            x-show="!loggedOut"
            @click="showModal = true">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
            </svg>
            Cerrar sesión
        </button>
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" x-transition>
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xs text-center">
                <h2 class="text-lg font-semibold mb-2">¿Cerrar sesión?</h2>
                <p class="mb-4 text-gray-600">¿Estás seguro que deseas cerrar sesión?</p>
                <div class="flex justify-center gap-4">
                    <form action="{{ route('cliente.logout') }}" method="POST"
                        @submit.prevent="
                            fetch($el.action, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            }).then(() => { window.location.reload(); });
                            showModal = false;
                        ">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Sí, cerrar sesión
                        </button>
                    </form>
                    <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300"
                        @click="showModal = false">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}"
            class="flex text-white text-center bg-yellow-500 py-2 px-4 rounded-md hover:bg-yellow-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
            Acceder
        </a>
    @endif
</div>

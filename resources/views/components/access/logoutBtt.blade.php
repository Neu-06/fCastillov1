@php
    // Detectar el tipo de usuario autenticado y ajustar rutas
    $isCliente = auth('cliente')->check();
    $isUsuario = auth()->check();
@endphp

<div x-data="{ loggedOut: false }">
    @if ($isUsuario)     <!-- usuario.logout -->
        <form action="{{ route('logout') }}" method="POST"
            @submit.prevent="
                fetch($el.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(() => { loggedOut = true; window.location.href = '{{ route('login') }}'; });
            ">
            @csrf
            <button type="submit"
                class="flex text-center text-white bg-red-500 py-2 px-4 rounded-md hover:bg-red-600"
                x-show="!loggedOut"
                onclick="return confirm('¿Seguro que deseas cerrar sesión?')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                </svg>
                Cerrar sesión
            </button>
            <a href="{{ route('login') }}"
                class="flex text-white text-center bg-blue-500 py-2 px-4 rounded-md hover:bg-blue-600"
                x-show="loggedOut">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                </svg>
                Acceder
            </a>
        </form>
    @elseif ($isCliente)
        <form action="{{ route('cliente.logout') }}" method="POST"
            @submit.prevent="
                fetch($el.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(() => { loggedOut = true; window.location.href = '{{ route('login') }}'; });
            ">
            @csrf
            <button type="submit"
                class="flex text-white bg-red-500 py-2 px-4 rounded-md hover:bg-red-600"
                x-show="!loggedOut"
                onclick="return confirm('¿Seguro que deseas cerrar sesión?')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                </svg>
                Cerrar sesión
            </button>
            <a href="{{ route('login') }}"
                class="flex text-white text-center bg-blue-500 py-2 px-4 rounded-md hover:bg-blue-600"
                x-show="loggedOut">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                </svg>
                Acceder
            </a>
        </form>
    @else
        <a href="{{ route('login') }}"
            class="flex text-white text-center bg-yellow-500 py-2 px-4 rounded-md hover:bg-yellow-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
            Acceder
        </a>
    @endif
</div>
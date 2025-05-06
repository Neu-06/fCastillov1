@auth
    <!-- SI el cliente ya está logueado -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="flex text-white bg-red-500 py-2 px-4 rounded-md hover:bg-red-600">
            Cerrar sesión
        </button>
    </form>
@else
    <!-- SI NO hay cliente logueado -->
    <a href="{{ url('/login') }}" class="flex text-white bg-blue-500 py-2 px-4 rounded-md hover:bg-blue-600">
        Acceder
    </a>
@endauth
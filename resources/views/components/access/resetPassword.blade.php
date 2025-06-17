<div class="h-auto flex justify-center mt-28">
    <div class="hidden lg:flex w-full lg:w-1/2 justify-around items-center bg-gray-600">
        <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
            <h1 class="text-white font-bold text-4xl font-sans">Ferreteria Castillo</h1>
            <p class="text-white mt-1">Encuentra lo que necesites para construir.</p>
        </div>
    </div>

    <div class="flex w-wLR">
        <div class="w-full">
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
            <form method="POST" action="{{ route('password.email') }}" class="bg-white rounded-md shadow-2xl p-5">
                @csrf
                <h1 class="text-tBlack text-center font-bold text-2xl pt-4 pb-10">Restablecer Contraseña</h1>

                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                    <input class="pl-2 w-full outline-none border-none" type="email" name="email"
                        placeholder="Correo Electrónico" required />
                </div>

                @if (session('status'))
                    <div class="mb-4 text-green-600 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 text-red-600 text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit"
                    class="block w-full bg-indigo-600 mt-6 py-2 rounded-2xl hover:bg-indigo-700 transition-all duration-500 text-white font-semibold mb-2">
                    Recibir enlace de restablecimiento
                </button>

                <div class="flex flex-col justify-center items-center mt-4 min-w-max gap-2">
                    <a href="{{ route('login') }}"
                        class="text-sm text-tLink cursor-pointer hover:-translate-y-1 duration-500 transition-all">
                        Volver al inicio de sesión
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

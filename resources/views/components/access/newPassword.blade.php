@props(['token', 'email'])
<div class="h-auto flex justify-center mt-28">
        <div class="hidden lg:flex w-full lg:w-1/2 justify-around items-center " style="background-image: url('/imagenes/iamgenRem.png')">
            <div class="bg-black/50 p-6 rounded-md">
                <h1 class="text-white font-extrabold text-5xl tracking-wide uppercase">FERRETERIA CASTILLO</h1>
                <p class="text-white mt-2 text-lg font-light">Encuentra lo que necesites para construir.</p>
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

            <form method="POST" action="{{ route('password.update') }}" class="bg-white rounded-md shadow-2xl p-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <h1 class="text-tBlack text-center font-bold text-2xl pt-4 pb-10">Nueva Contraseña</h1>

                <div class="flex items-center border-2 mb-6 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4z" />
                    </svg>
                    <input class="pl-2 w-full outline-none border-none" type="password" name="password"
                        placeholder="Nueva contraseña" required minlength="6" />
                </div>

                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4z" />
                    </svg>
                    <input class="pl-2 w-full outline-none border-none" type="password" name="password_confirmation"
                        placeholder="Confirmar contraseña" required minlength="6" />
                </div>

                @if ($errors->any())
                    <div class="mb-4 text-red-600 text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit"
                    class="block w-full bg-indigo-600 mt-6 py-2 rounded-2xl hover:bg-indigo-700 transition-all duration-500 text-white font-semibold mb-2">
                    Guardar nueva contraseña
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
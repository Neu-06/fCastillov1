
@if ($isCliente || $isUsuario)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
            <h2 class="text-lg font-bold mb-4 text-red-600">¡Atención!</h2>
            <p class="mb-6">Para iniciar sesión o registrar una nueva cuenta, primero debes cerrar sesión.
            </p>
            <div class="flex justify-center gap-4">                               <!-- usuario.logout -->
                <form method="POST" action="{{ $isCliente ? route('cliente.logout') : route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Cerrar sesión
                    </button>
                </form>
                <button onclick="window.location.href='{{ url()->previous() }}'"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
@else
    <div class="h-auto flex justify-center mt-28">
        <div class="hidden lg:flex w-full lg:w-1/2 justify-around items-center " style="background-image: url('/imagenes/iamgenRem.png')">
            <div class="bg-black/50 p-6 rounded-md">
                <h1 class="text-white font-extrabold text-5xl tracking-wide uppercase">FERRETERIA CASTILLO</h1>
                <p class="text-white mt-2 text-lg font-light">Encuentra lo que necesites para construir.</p>
            </div>

        </div>

        <div class="flex w-wLR">
            <div class="w-full">

                <form method="POST" action="{{ route('login.post') }}" class="bg-white rounded-md shadow-2xl p-5">
                    @csrf
                    <h1 class="text-tBlack text-center font-bold text-2xl pt-4 pb-14">Iniciar Sesión</h1>

                    <!-- Campo de correo -->
                    <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input id="email" class="pl-2 w-full outline-none border-none" type="email" name="correo"
                            placeholder="Correo Electrónico" required />
                    </div>

                    <!-- Campo de contraseña -->
                    <div class="flex items-center border-2 mb-0 py-2 px-3 rounded-2xl relative" x-data="{ show: false }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <input id="password" class="pl-2 w-full outline-none border-none"
                            :type="show ? 'text' : 'password'" name="password" placeholder="Contraseña" required
                            autocomplete="current-password" />
                        <button type="button" tabindex="-1" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center px-3 focus:outline-none">
                            <!-- Ojo cerrado -->
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-1.657.336-3.234.938-4.675m1.675-1.675A9.956 9.956 0 0112 3c5.523 0 10 4.477 10 10 0 1.657-.336 3.234-.938 4.675m-1.675 1.675A9.956 9.956 0 0112 21c-5.523 0-10-4.477-10-10 0-1.657.336-3.234.938-4.675" />
                            </svg>
                            <!-- Ojo abierto -->
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a9.77 9.77 0 01-1.5 3.5M2.5 12a9.77 9.77 0 011.5-3.5m15.5 3.5a9.77 9.77 0 01-1.5 3.5m-13-3.5a9.77 9.77 0 011.5-3.5m13 0A9.77 9.77 0 0121.5 12m-19 0A9.77 9.77 0 012.5 12" />
                            </svg>
                        </button>
                    </div>
                    {{-- Mensaje de error --}}
                    @if ($errors->has('correo'))
                        <div id="login-error"
                            class="absolute px-4 py-2 text-sm my-1 mr-2 bg-red-100 text-red-700 rounded">
                            {{ $errors->first('correo') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                const errorDiv = document.getElementById('login-error');
                                if (errorDiv) errorDiv.style.display = 'none';
                            }, 3000); // 4 segundos
                        </script>
                    @endif
                    <!-- Botón de inicio de sesión -->
                    <button type="submit"
                        class="block w-full bg-indigo-600 mt-10 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-0.5
                     transition-all duration-500 text-white font-semibold mb-2">Ingresar</button>

                    <!-- Opciones adicionales -->
                    <div class="flex flex-col justify-center items-center mt-4 min-w-max gap-2">
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-tLink cursor-pointer hover:-translate-y-1 duration-500 transition-all">
                            ¿Olvidaste tu contraseña?
                        </a>

                        <span class="text-tBlack text-sm">¿No tienes cuenta? <a href="{{ route('cliente.registro') }}"
                                class="text-sm pl-1 text-tLink cursor-pointer hover:-translate-y-1 duration-500 transition-all">
                                Regístrate
                            </a>
                        </span>

                    </div>
                </form>


            </div>
        </div>
    </div>
@endif

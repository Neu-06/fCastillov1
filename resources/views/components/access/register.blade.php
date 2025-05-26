
@if ($isCliente || $isUsuario)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
            <h2 class="text-lg font-bold mb-4 text-red-600">¡Atención!</h2>
            <p class="mb-6">Para iniciar sesión o registrar una nueva cuenta, primero debes cerrar sesión.
            </p>
            <div class="flex justify-center gap-4">                                 <!-- usuario.logout -->
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
    <div class="h-auto flex justify-center mt-5">
        <div class="hidden lg:flex w-full lg:w-1/2 justify-around items-center bg-gray-600">    
            <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
                <h1 class="text-white font-bold text-4xl font-sans">Ferreteria Castillo</h1>
                <p class="text-white mt-1">Todo lo que necesites para construir.</p>
            </div>
        </div>


        <div class="flex w-wLR">
            <div class="w-full p-4">
                <form action="{{ route('cliente.public.store') }}" method="POST"
                    class="bg-white rounded-md shadow-2xl p-5">
                    @csrf

                    <h1 class="text-tBlack text-center font-bold text-2xl pt-4 pb-10">Registrate</h1>
                    @if ($errors->any())
                        <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flex items-center border-2 mb-4 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>

                        <input id="nombre_cliente" class="pl-2 w-full outline-none border-none" type="text"
                            name="nombre_cliente" placeholder="Nombre" value="{{ old('nombre_cliente') }}" required />
                     </div>
                          
                    <div class="flex items-center border-2 mb-4 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>

                        <input id="apellidos_cliente" class="pl-2 w-full outline-none border-none" type="text"
                            name="apellido_cliente" placeholder="Apellidos" value="{{ old('apellido_cliente') }}"
                            required />
                    </div>

                    <div class="flex items-center border-2 mb-4 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input id="correo_cliente" class="pl-2 w-full outline-none border-none" type="email"
                            name="correo_cliente" placeholder="Correo Electrónico" value="{{ old('correo_cliente') }}"
                            required />
                    </div>

                    <div class="flex items-center border-2 mb-4 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>

                        <input id="telefono_cliente" class="pl-2 w-full outline-none border-none" type="text"
                            name="telefono_cliente" placeholder="Número de Celular" pattern="[0-9]*" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            value="{{ old('telefono_cliente') }}" />
                    </div>

                    <div class="flex items-center border-2 mb-4 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <input id="direccion_cliente" class="pl-2 w-full outline-none border-none" type="text"
                            name="direccion_cliente" value="{{ old('direccion_cliente') }}"
                            placeholder="Dirección" />
                    </div>

                    <div class="flex items-center border-2 mb-6 py-2 px-3 rounded-2xl relative"
                        x-data="{ show: false }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <input id="password_cliente" class="pl-2 w-full outline-none border-none"
                            :type="show ? 'text' : 'password'" name="password_cliente"
                            placeholder="Contraseña (minimo 6 caracteres)" required minlength="6"
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

                    <button type="submit"
                        class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1
                     transition-all duration-500 text-white font-semibold mb-2">Registrar</button>
                    <div class="flex justify-center mt-4 min-w-max">

                        <span class="text-tBlack text-sm">
                            ya tienes una cuenta?<a href="{{ route('login') }}"
                                class="text-sm pl-1 text-tLink cursor-pointer hover:-translate-y-1 duration-500 transition-all">
                                ingresar
                            </a>
                        </span>

                    </div>
                    <input type="hidden" name="registro_publico" value="1">
                </form>

            </div>

        </div>
    </div>
@endif

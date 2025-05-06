<div class="h-auto flex justify-center mt-5">
    <div class="hidden lg:flex w-full lg:w-1/2 justify-around items-center bg-gray-600">
        <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
            <h1 class="text-white font-bold text-4xl font-sans">Ferreteria Castillo</h1>
            <p class="text-white mt-1">Todo lo que necesites para construir.</p>
        </div>
    </div>


    <div class="flex w-wLR">
        <div class="w-full">
            <form method="POST" action="/register" class="bg-white rounded-md shadow-2xl p-5">
                @csrf

                <h1 class="text-tBlack text-center font-bold text-2xl pt-4 pb-14">Registrate</h1>

                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>
                      
                    <input id="nombreC" class=" pl-2 w-full outline-none border-none" type="text" name="nombre"
                        placeholder="Nombre" />
                </div>

                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>
                      
                    <input id="apellidosC" class=" pl-2 w-full outline-none border-none" type="text" name="apellidos"
                        placeholder="apellidos" />
                </div>

                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                    <input id="email" class=" pl-2 w-full outline-none border-none" type="email" name="email"
                        placeholder="Correo Electronico" />
                </div>

                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                      </svg>
                      
                    <input id="numeroC" class=" pl-2 w-full outline-none border-none" type="number" name="celular"
                        placeholder="numero de celular" />
                </div>

                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                      </svg>
                      
                    <input id="direccionC" class=" pl-2 w-full outline-none border-none" type="text" name="direccion"
                        placeholder="Direccion" />
                </div>

                <div class="flex items-center border-2 mb-12 py-2 px-3 rounded-2xl ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fillRule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clipRule="evenodd" />
                    </svg>
                    <input class="pl-2 w-full outline-none border-none" type="password" name="password" id="password"
                        placeholder="Contraseña" />

                </div>

                <button type="submit"
                    class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1
                     transition-all duration-500 text-white font-semibold mb-2">Registrar</button>
                <div class="flex justify-between mt-4 min-w-max">

                    <span class="text-tBlack text-sm">
                        ya tienes una cuenta?
                    </span>
                    <a href="/login"
                        class="text-sm pl-1 text-tLink cursor-pointer hover:-translate-y-1 duration-500 transition-all">
                        ingresar
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

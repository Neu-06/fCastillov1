{{-- Desktop --}}
<div class="hidden md:block">
    <div class="relative mx-auto w-full max-w-6xl">
        <input
            type="text"
            placeholder="Buscar"
            class="w-full pl-5 pr-16 py-2.5 text-gray-700 placeholder-gray-400 border border-navBlue rounded-full outline-none focus:outline-none focus:ring-0 transition"
        >
        <button type="submit"
            class="absolute top-1/2 -translate-y-1/2 right-1.5 bg-navBlue rounded-full p-2 hover:bg-blue-900 shadow-none focus:shadow-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
            </svg>
        </button>
    </div>
</div>

{{-- Mobile --}}
<div class="block md:hidden">
    <div class="relative mx-auto w-full max-w-sm px-4">
        <input
            type="text"
            placeholder="Buscar"
            class="w-full pl-4 pr-12 py-2 text-sm text-gray-700 placeholder-gray-400 border border-navBlue rounded-full outline-none focus:outline-none focus:ring-0 transition"
        >
        <button type="submit"
            class="absolute top-1/2 -translate-y-1/2 right-2 bg-navBlue rounded-full p-2 hover:bg-blue-900 shadow-none focus:shadow-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
            </svg>
        </button>
    </div>
</div>

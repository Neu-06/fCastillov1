<!-- component -->
<div class="max-w-4xl mx-auto mt-5">

    <x-gestion.elementoTabla.headerG texto='Usuario'/>

    <div class="p-0 overflow-scroll">

        <table class="w-full mt-4 text-left table-auto min-w-max">
            
            {{-- encabezado de la tabla --}}

            <x-gestion.elementoTabla.nombreColumnaU />

            {{-- cuerpo de la tabla para filas --}}
            <tbody>

                {{-- @foreach ($users as $user)
                    <x-gestion.elementoTabla.filaGU :user="$user" />
                @endforeach 
                <x-gestion.elementoTabla.filaGU/>--}}
            </tbody>

        </table>

    </div>


    {{-- <div class="flex items-center justify-between p-3">
        <p class="block text-sm text-slate-500">
            Page 1 of 10
        </p>
        <div class="flex gap-1">
            <button
                class="rounded border border-slate-300 py-2.5 px-3 text-center text-xs font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                Atras
            </button>
            <button
                class="rounded border border-slate-300 py-2.5 px-3 text-center text-xs font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                Siguiente
            </button>
        </div>
    </div> --}}

</div>
</div>

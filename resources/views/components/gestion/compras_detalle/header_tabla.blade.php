
<div class="flex items-center justify-between p-4 ">
    <div>
        <h3 class="text-lg font-semibold text-slate-800">Lista de Compras</h3>
        <p class="text-slate-500">Revisar bien antes de editar.</p>
    </div>
    
</div>
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
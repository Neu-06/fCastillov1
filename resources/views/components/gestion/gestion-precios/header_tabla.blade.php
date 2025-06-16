
@if (session('success'))
    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('success') }}
    </div>

    <script>
        // Espera 4 segundos (4000 ms) y oculta el mensaje
        setTimeout(() => {
            const msg = document.getElementById('success-message');
            if (msg) {
                msg.style.transition = "opacity 0.5s ease";
                msg.style.opacity = 0;
                setTimeout(() => msg.remove(), 500);
            }
        }, 4000);
    </script>
@endif


<div class="flex items-center justify-between p-4 ">
    <div>
        <h3 class="text-lg font-semibold text-slate-800">Lista de Producto con su información Compra/Venta</h3>
        <p class="text-slate-500">Revisar bien antes de editar.</p>
    </div>
<tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider border-b">
    <th class="px-4 py-2 text-center">código</th>
    <th class="px-4 py-2 text-left">nombre del producto</th>
    <th class="px-4 py-2 text-center">stock disponible</th>
    <th class="px-4 py-2 text-center">precio de compra</th>
    <th class="px-4 py-2 text-center">precio de venta</th>
    <th class="px-4 py-2 text-center">acciones</th>
</tr>

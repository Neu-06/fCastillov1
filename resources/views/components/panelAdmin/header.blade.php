<div class="mb-6 border-b pb-4 flex items-center justify-between">
  <div>
    <h1 class="text-2xl font-bold text-gray-800">{{ $titulo }}</h1>
    @isset($subtitulo)
      <p class="text-gray-600">{{ $subtitulo }}</p>
    @endisset
  </div>
  <!-- Puedes colocar aquí un botón o avatar -->
  <div>
    <span class="text-gray-600">Admin</span>
  </div>
</div>

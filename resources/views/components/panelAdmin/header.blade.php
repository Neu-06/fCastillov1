<div class="mb-6 px-2  border-b pb-4 flex items-center justify-between">
  <div>
    <h1 class="h1-global text-gray-800">{{ $titulo }}</h1>
    @isset($subtitulo)
      <p class="text-gray-600 p-global">{{ $subtitulo }}</p>
    @endisset
  </div>
  <!-- Puedes colocar aquí un botón o avatar -->
  <div>
    <span class="text-gray-600">Admin</span>
  </div>
</div>

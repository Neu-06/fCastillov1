@@ -0,0 +1,57 @@
@extends('layouts.admin')

@section('title', 'Gestión de Proveedores')

@section('contenido')
@include('components.header.headerAdmin', [
    'titulo' => 'Gestión de Proveedores',
    'subtitulo' => 'Administración de los proveedores registrados.'
])
@if (session('success'))
<div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow">
    {{ session('success') }}
</div>
@endif

<div class="mt-6">
    <!-- Botón crear proveedor -->
    <div class="mb-4">
        <a href="{{ route('proveedor.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
            + Nuevo Proveedor
        </a>
    </div>

    <!-- Tabla de proveedores -->
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Teléfono</th>
                    <th class="px-6 py-3">Correo</th>
                    <th class="px-6 py-3">Dirección</th>
                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y">
                @foreach($proveedores as $proveedor)
                    <tr>
                        <td class="px-6 py-4">{{ $proveedor->id_proveedor }}</td>
                        <td class="px-6 py-4">{{ $proveedor->nombre }}</td>
                        <td class="px-6 py-4">{{ $proveedor->telefono }}</td>
                        <td class="px-6 py-4">{{ $proveedor->email }}</td>
                        <td class="px-6 py-4">{{ $proveedor->direccion }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('proveedor.edit', $proveedor->id_proveedor) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

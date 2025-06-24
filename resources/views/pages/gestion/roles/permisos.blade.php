@extends('layouts.panelAdmin')

@section('title', 'Permisos del Rol')

@section('contenido')
    @include('components.panelAdmin.header', [
        'titulo' => 'Gestión de Roles',
        'subtitulo' => 'Administración de Roles del sistema.',
    ])
<div class="w-full overflow-x-auto mt-6 bg-white shadow rounded-lg p-6">
        <!-- Título -->
        <h2 class="h2-global mb-4">
            Permisos del Rol: {{ $rol->nombre_rol }}
        </h2>

        <!-- Lista de permisos -->
       
@include('components.gestion.roles.tabla_permisos', [
    'rol' => $rol,
    'permisos' => $permisos,
    'casosDeUso' => $casosDeUso,
    'soloLectura' => true
])
    @error('permisos')
    
            {{ $message }}
      
    @enderror
   
        <!-- Enlace para volver -->
        <div class="mt-6">
            <a href="{{ route('rol.index') }}" class="text-blue-600 hover:underline text-sm">← Volver a la lista de roles</a>
        </div>
    </div>
@endsection

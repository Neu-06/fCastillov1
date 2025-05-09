<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        /// Crear el rol 'Administrador'
        $rol = new Rol();
        $rol->nombre_rol="Administrador";
        $rol->save();


        // Crear usuario con el rol 'Administrador'
        $usuario = new Usuario();
        $usuario->nombre_usuario = 'SuperAdmin';
        $usuario->correo_usuario = 'admin@admin.com';
        $usuario->password_usuario = Hash::make('123456');
        $usuario->id_rol = 1; 
        $usuario->save();

    }
}

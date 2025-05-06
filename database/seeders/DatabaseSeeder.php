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
       

        $rol = new Rol();
        $rol->nombre="Administrador";
        $rol->save();


        // Crear usuario con el rol 'Administrador'
        $usuario = new Usuario();
        $usuario->ci = '9689194';
        $usuario->nombre = 'jhonny ojeda claros';
        $usuario->correo = 'ojedaclarosjhonny@gmail.com';
        $usuario->contrasena = Hash::make('123456789');
        $usuario->estado = true;
        $usuario->id_rol = $rol->id; // Relación con el rol recién creado
        $usuario->save();

    }
}

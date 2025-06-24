<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   // 1. Cargar los permisos primero
        $this->call(PermisosSeeder::class); // 👈 llamar aquí el seeder

        //2. Crear el rol 'Administrador' si no existe
        $rol = Rol::firstOrCreate(['nombre_rol' => 'Administrador']);

        // 3. Asignar todos los permisos existentes a este rol
        $permisos = Permiso::pluck('id_permiso')->toArray();
        $rol->permisos()->sync($permisos);

        // 4. Crear el usuario administrador
        $usuario = Usuario::firstOrCreate(
            ['correo_usuario' => 'admin@admin.com'],
            [
                'nombre_usuario' => 'SuperAdmin',
                'password_usuario' => '123456', // se encripta automáticamente
                'id_rol' => $rol->id_rol,
            ]
        );

         // 5. Cargar las categorías de productos de ferretería
             $this->call(CategoriaSeeder::class);

         // 6. Cargar las marcas de productos de ferretería
             $this->call(MarcaSeeder::class);


         // 6. Cargar los proveedores de la ferretería
              $this->call(ProveedorSeeder::class);
    }
}

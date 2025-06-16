<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permiso;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Listas de casos de usos con las determinadas acciones que se pueden hacer en dicho CU
        $permisosPorCu = [
            'Usuarios' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Roles' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Permisos' => ['Agregar', 'Eliminar', 'Ver'],
            'Proveedores' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Clientes' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Productos' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Marcas' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Categorias' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Compras' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Ventas' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
            'Bitacoras' => ['Agregar', 'Editar', 'Eliminar', 'Ver'],
        ];

        foreach ($permisosPorCu as $cu => $acciones) {
            foreach ($acciones as $accion) {
                Permiso::firstOrCreate([
                    //firstorcreate, busca si ya existe un permiso con ese nombre_permiso,
                    //si no existe la crea
                    'nombre_permiso' => "$accion $cu"
                ]);
            }
        }
    }
}

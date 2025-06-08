<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('proveedores')->insert([
        [
            'nombreC_proveedor' => 'Distribuidora Andina',
            'correo_proveedor' => 'andina@example.com',
            'telefono_proveedor' => '777111222',
            'direccion_proveedor' => 'Av. Siempre Viva 123',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'nombreC_proveedor' => 'Bebidas Norteña',
            'correo_proveedor' => 'nortena@example.com',
            'telefono_proveedor' => '777333444',
            'direccion_proveedor' => 'Calle 2 #456',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'nombreC_proveedor' => 'Distribuidora Villarroel',
            'correo_proveedor' => 'villarroel@example.com',
            'telefono_proveedor' => '777555666',
            'direccion_proveedor' => 'Zona Central',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'nombreC_proveedor' => 'Importadora Bolívar',
            'correo_proveedor' => 'bolivar@example.com',
            'telefono_proveedor' => '777888999',
            'direccion_proveedor' => 'Av. Bolívar 789',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'nombreC_proveedor' => 'Cervecería Nacional',
            'correo_proveedor' => 'cerveceria@example.com',
            'telefono_proveedor' => '777000111',
            'direccion_proveedor' => 'Parque Industrial',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    ]);
    }
}

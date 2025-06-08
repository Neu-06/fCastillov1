<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('categorias')->insert([
            ['nombre_categoria' => 'Herramientas manuales'],
            ['nombre_categoria' => 'Herramientas eléctricas'],
            ['nombre_categoria' => 'Pinturas y solventes'],
            ['nombre_categoria' => 'Materiales de construcción'],
            ['nombre_categoria' => 'Fontanería'],
            ['nombre_categoria' => 'Electricidad'],
            ['nombre_categoria' => 'Ferretería general'],
            ['nombre_categoria' => 'Tornillería y fijaciones'],
            ['nombre_categoria' => 'Seguridad industrial'],
            ['nombre_categoria' => 'Adhesivos y selladores'],
        ]);
    }
}

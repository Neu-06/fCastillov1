<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('marcas')->insert([
             ['nombre_marca' => 'Truper'],
              ['nombre_marca' => 'Stanley'],
              ['nombre_marca' => 'Bosch'],
             ['nombre_marca' => 'Makita'],
               ['nombre_marca' => 'DeWalt'],
              ['nombre_marca' => '3M'],
             ['nombre_marca' => 'Irwin'],
             ['nombre_marca' => 'Black+Decker'],
             ['nombre_marca' => 'Klein Tools'],
             ['nombre_marca' => 'WD-40'],
]);
    }
}

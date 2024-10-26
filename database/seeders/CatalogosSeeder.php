<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosSeeder extends Seeder
{
    public function run()
    {
        DB::table('catalogos')->insert([
            ['Codigo'=> 1,
            'nombre' => 'Género'],

            ['Codigo'=> 2,
            'nombre' => 'Presentación'],

            ['Codigo'=> 3,
            'nombre' => 'Uso'],

            ['Codigo'=> 4,
            'nombre' => 'Estado'],

            ['Codigo'=> 5,
            'nombre' => 'Especialidad'],

            // Agrega más categorías según sea necesario
        ]);
    }
}

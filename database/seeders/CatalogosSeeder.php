<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosSeeder extends Seeder
{
    public function run()
    {
        DB::table('catalogos')->insert([
            ['Codigo' => 1, 'nombre' => 'Género', 'created_at' => now(), 'updated_at' => now()],
            ['Codigo' => 2, 'nombre' => 'Presentación', 'created_at' => now(), 'updated_at' => now()],
            ['Codigo' => 3, 'nombre' => 'Uso', 'created_at' => now(), 'updated_at' => now()],
            ['Codigo' => 4, 'nombre' => 'Estado', 'created_at' => now(), 'updated_at' => now()],
            ['Codigo' => 5, 'nombre' => 'Especialidad', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

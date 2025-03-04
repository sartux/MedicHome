<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlergiasSeeder extends Seeder
{
    public function run()
    {
        // Insertar alergias comunes
        DB::table('alergias')->insert([
            ['nombre' => 'Penicilina', 'descripcion' => 'Alergia a antibióticos de tipo penicilina', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Aspirina', 'descripcion' => 'Alergia al ácido acetilsalicílico', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Látex', 'descripcion' => 'Alergia al látex de caucho natural', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Maní', 'descripcion' => 'Alergia alimentaria al maní/cacahuate', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Frutos secos', 'descripcion' => 'Alergia a frutos de cáscara', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Mariscos', 'descripcion' => 'Alergia a mariscos', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Polen', 'descripcion' => 'Alergia al polen de árboles o plantas', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ácaros', 'descripcion' => 'Alergia a los ácaros del polvo', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Picadura de abeja', 'descripcion' => 'Alergia al veneno de abeja', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Huevo', 'descripcion' => 'Alergia alimentaria al huevo', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
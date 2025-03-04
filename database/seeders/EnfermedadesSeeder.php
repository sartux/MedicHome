<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnfermedadesSeeder extends Seeder
{
    public function run()
    {
        // Insertar enfermedades comunes
        DB::table('enfermedades')->insert([
            ['nombre' => 'Hipertensión', 'descripcion' => 'Presión arterial alta', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Diabetes Tipo 1', 'descripcion' => 'Diabetes insulinodependiente', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Diabetes Tipo 2', 'descripcion' => 'Diabetes no insulinodependiente', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Asma', 'descripcion' => 'Enfermedad respiratoria crónica', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Enfermedad Coronaria', 'descripcion' => 'Afección del corazón', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Artritis', 'descripcion' => 'Inflamación de las articulaciones', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Hipotiroidismo', 'descripcion' => 'Glándula tiroides poco activa', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Hipertiroidismo', 'descripcion' => 'Glándula tiroides hiperactiva', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Epilepsia', 'descripcion' => 'Trastorno neurológico', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Enfermedad Renal Crónica', 'descripcion' => 'Insuficiencia renal de largo plazo', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
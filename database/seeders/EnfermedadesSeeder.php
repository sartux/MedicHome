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
            
            // Enfermedades adicionales
            ['nombre' => 'Migraña', 'descripcion' => 'Cefalea intensa y recurrente', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Fibromialgia', 'descripcion' => 'Dolor musculoesquelético crónico', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Enfermedad de Crohn', 'descripcion' => 'Enfermedad inflamatoria intestinal', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Colitis Ulcerosa', 'descripcion' => 'Inflamación crónica del colon', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Psoriasis', 'descripcion' => 'Enfermedad autoinmune que afecta la piel', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Lupus Eritematoso Sistémico', 'descripcion' => 'Enfermedad autoinmune multiorgánica', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Esclerosis Múltiple', 'descripcion' => 'Enfermedad desmielinizante del sistema nervioso', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'EPOC', 'descripcion' => 'Enfermedad Pulmonar Obstructiva Crónica', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Anemia Ferropénica', 'descripcion' => 'Déficit de hierro en sangre', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Apnea del Sueño', 'descripcion' => 'Trastorno respiratorio durante el sueño', 'CATA_Estado' => 41, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
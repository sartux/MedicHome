<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicamentosSeeder extends Seeder
{
    public function run()
    {
        DB::table('medicamentos')->insert([
            [
                'Nombre' => 'Ibuprofeno',
                'Composicion' => 'Ibuprofeno 400mg',
                'CATA_presentacion' => 21, // Tabletas
                'CATA_Uso' => 31, // Otico
                'CATA_Especialidad' => 51, // Oncología
                'Observaciones' => 'Tomar después de las comidas.',
                'CATA_Estado' => 41 // Activo
            ],
            [
                'Nombre' => 'Paracetamol',
                'Composicion' => 'Paracetamol 500mg',
                'CATA_presentacion' => 21, // Tabletas
                'CATA_Uso' => 30, // No Aplica
                'CATA_Especialidad' => 52, // Dermatología
                'Observaciones' => 'No exceder la dosis recomendada.',
                'CATA_Estado' => 41 // Activo
            ],
            [
                'Nombre' => 'Amoxicilina',
                'Composicion' => 'Amoxicilina 500mg',
                'CATA_presentacion' => 23, // Jarabe
                'CATA_Uso' => 32, // Ocular
                'CATA_Especialidad' => 53, // Pediatría
                'Observaciones' => 'Completar el tratamiento aunque los síntomas mejoren.',
                'CATA_Estado' => 41 // Activo
            ],
            [
                'Nombre' => 'Aspirina',
                'Composicion' => 'Aspirina 100mg',
                'CATA_presentacion' => 21, // Tabletas
                'CATA_Uso' => 33, // Tópico
                'CATA_Especialidad' => 54, // Cardiología
                'Observaciones' => 'No tomar con alcohol.',
                'CATA_Estado' => 41 // Activo
            ],
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdenMedicaSeeder extends Seeder
{
    public function run()
    {
        DB::table('ordenes_medicas')->insert([
            [
                'Familiar_id' => 1,
                'CATA_Especialidad' => 51, // ID de 'Especialidad'
                'Procedimiento' => 'Examen de.',
                'Fecha_Resetada' => '2024-01-01',
                'Medico_Reseta' => 'Dr. Pérez',
                'Centro_Medico' => 'INC',
                'Ciudad'=> 'Bogota',
                'Pre_requisitos' => 'Exámenes previos requeridos.',
                'Observaciones' => 'Controlar presión arterial.',
                'CATA_Estado' => 41
            ],
            // Agrega más órdenes según sea necesario
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitaMedicaSeeder extends Seeder
{
    public function run()
    {
        DB::table('citas_medicas')->insert([
            [
                'OrdenMedica_id' => 1,
                'Fecha_Hora_Cita' => '2024-01-10 10:00:00'
            ],
            // Agrega más citas según sea necesario
        ]);
    }
}

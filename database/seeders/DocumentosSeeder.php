<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentosSeeder extends Seeder
{
    public function run()
    {
        DB::table('documentos')->insert([
            [
                'Familiar_id' => 1,
                'OrdenMedica_id' => 1,
                'CATA_Especialidad' => 51,
                'Fecha_documento' => '2024-01-01',
                'CATA_Estado' => 41
            ],
            // Agrega más documentos según sea necesario
        ]);
    }
}

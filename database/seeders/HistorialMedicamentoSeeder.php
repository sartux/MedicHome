<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorialMedicamentoSeeder extends Seeder
{
    public function run()
    {
        DB::table('historial_medicamentos')->insert([
            // Medicamentos para Oscar Silvio (ID de Familiar: 1)
            ['Familiar_id' => 1, 'medicamento_id' => 1, 'descripcion_tratamiento' => 'Tratamiento para hipertensión', 'dosis' => '1 tableta diaria', 'fecha_inicio' => '2024-01-01', 'fecha_final' => null, 'CATA_Estado' => 41],
            ['Familiar_id' => 1, 'medicamento_id' => 2, 'descripcion_tratamiento' => 'Tratamiento para colesterol alto', 'dosis' => '1 cápsula en la mañana', 'fecha_inicio' => '2024-02-01', 'fecha_final' => '2024-03-30', 'CATA_Estado' => 41],
            ['Familiar_id' => 1, 'medicamento_id' => 3, 'descripcion_tratamiento' => 'Suplemento de vitamina D', 'dosis' => '2 tabletas al día', 'fecha_inicio' => '2024-03-01', 'fecha_final' => null, 'CATA_Estado' => 41],

            // Medicamentos para Sergio Eduardo (ID de Familiar: 2)
            ['Familiar_id' => 2, 'medicamento_id' => 4, 'descripcion_tratamiento' => 'Antibiótico para infección', 'dosis' => '500 mg cada 8 horas', 'fecha_inicio' => '2024-01-15', 'fecha_final' => '2024-01-30', 'CATA_Estado' => 41],
            ['Familiar_id' => 2, 'medicamento_id' => 1, 'descripcion_tratamiento' => 'Tratamiento para migraña', 'dosis' => '1 tableta al inicio del dolor', 'fecha_inicio' => '2024-02-10', 'fecha_final' => null, 'CATA_Estado' => 41],
            ['Familiar_id' => 2, 'medicamento_id' => 2, 'descripcion_tratamiento' => 'Antialérgico', 'dosis' => '1 tableta diaria por la noche', 'fecha_inicio' => '2024-03-05', 'fecha_final' => null, 'CATA_Estado' => 41],

            // Medicamentos para Silvia Viviana (ID de Familiar: 3)
            ['Familiar_id' => 3, 'medicamento_id' => 3, 'descripcion_tratamiento' => 'Antiinflamatorio para dolor articular', 'dosis' => '1 tableta cada 12 horas', 'fecha_inicio' => '2024-04-01', 'fecha_final' => null, 'CATA_Estado' => 41],
            ['Familiar_id' => 3, 'medicamento_id' => 4, 'descripcion_tratamiento' => 'Tratamiento para ansiedad', 'dosis' => '1 cápsula diaria', 'fecha_inicio' => '2024-05-01', 'fecha_final' => null, 'CATA_Estado' => 41],
            ['Familiar_id' => 3, 'medicamento_id' => 1, 'descripcion_tratamiento' => 'Calcio y vitamina D', 'dosis' => '1 tableta diaria', 'fecha_inicio' => '2024-06-01', 'fecha_final' => null, 'CATA_Estado' => 41]
        ]);
    }
}
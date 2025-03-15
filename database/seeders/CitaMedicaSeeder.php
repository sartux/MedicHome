<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitaMedicaSeeder extends Seeder
{
    public function run()
    {
        // Obtener los IDs de las órdenes médicas existentes
        $ordenes = DB::table('ordenes_medicas')->select('id')->get();
        
        if ($ordenes->isEmpty()) {
            echo "No hay órdenes médicas en la base de datos. Por favor, ejecute el OrdenMedicaSeeder primero.\n";
            return;
        }
        
        // Mapeamos los IDs para tener una referencia fácil
        $ordenIds = $ordenes->pluck('id')->toArray();
        
        // Verificamos que tengamos suficientes órdenes
        if (count($ordenIds) < 4) {
            echo "No hay suficientes órdenes médicas en la base de datos. Se necesitan al menos 4.\n";
            return;
        }
        
        DB::table('citas_medicas')->insert([
            // Citas para la primera orden médica
            [
                'OrdenMedica_id' => $ordenIds[0],
                'Fecha_Hora_Cita' => Carbon::now()->addDays(7)->setHour(10)->setMinute(30),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'OrdenMedica_id' => $ordenIds[0],
                'Fecha_Hora_Cita' => Carbon::now()->addMonths(3)->setHour(15)->setMinute(0),
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Citas para la segunda orden médica
            [
                'OrdenMedica_id' => $ordenIds[1],
                'Fecha_Hora_Cita' => Carbon::now()->addDays(14)->setHour(9)->setMinute(0),
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Citas para la tercera orden médica
            [
                'OrdenMedica_id' => $ordenIds[2],
                'Fecha_Hora_Cita' => Carbon::now()->addDays(5)->setHour(14)->setMinute(15),
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Citas para la cuarta orden médica
            [
                'OrdenMedica_id' => $ordenIds[3],
                'Fecha_Hora_Cita' => Carbon::now()->addDays(10)->setHour(11)->setMinute(45),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
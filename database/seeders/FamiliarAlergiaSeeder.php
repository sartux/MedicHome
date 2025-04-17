<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliarAlergiaSeeder extends Seeder
{
    public function run()
    {
        // Obtener IDs de familiares y alergias
        $familiares = DB::table('familiares')->pluck('id')->toArray();
        $alergias = DB::table('alergias')->pluck('id')->toArray();
        
        if (empty($familiares) || empty($alergias)) {
            echo "No hay suficientes familiares o alergias en la base de datos.\n";
            return;
        }
        
        // Asignar alergias a familiares
        $data = [
            // Familiar 1 (Oscar Silvio) - alérgico a penicilina
            [
                'familiar_id' => $familiares[0],
                'alergia_id' => $alergias[0], // Penicilina
                'notas' => 'Reacción grave con hinchazón, reportado en historia clínica',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Familiar 2 (Sergio Eduardo) - alérgico al maní y látex
            [
                'familiar_id' => $familiares[1],
                'alergia_id' => $alergias[3], // Maní
                'notas' => 'Alergia severa, lleva autoinyector de epinefrina',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'familiar_id' => $familiares[1],
                'alergia_id' => $alergias[2], // Látex
                'notas' => 'Reacción cutánea leve al contacto con guantes de látex',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Familiar 3 (Silvia Viviana) - alérgica al polen y ácaros
            [
                'familiar_id' => $familiares[2],
                'alergia_id' => $alergias[6], // Polen
                'notas' => 'Rinitis alérgica estacional, peor en primavera',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'familiar_id' => $familiares[2],
                'alergia_id' => $alergias[7], // Ácaros
                'notas' => 'Usa fundas antiácaros en almohadas y colchón',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        
        DB::table('familiar_alergia')->insert($data);
    }
}
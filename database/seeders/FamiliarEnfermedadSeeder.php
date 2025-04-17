<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliarEnfermedadSeeder extends Seeder
{
    public function run()
    {
        // Obtener IDs de familiares y enfermedades
        $familiares = DB::table('familiares')->pluck('id')->toArray();
        $enfermedades = DB::table('enfermedades')->pluck('id')->toArray();
        
        if (empty($familiares) || empty($enfermedades)) {
            echo "No hay suficientes familiares o enfermedades en la base de datos.\n";
            return;
        }
        
        // Asignar enfermedades a familiares
        $data = [
            // Familiar 1 (Oscar Silvio) - tiene hipertensión y diabetes tipo 2
            [
                'familiar_id' => $familiares[0],
                'enfermedad_id' => $enfermedades[0], // Hipertensión
                'notas' => 'Diagnosticado en 2018, controlada con medicación diaria',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'familiar_id' => $familiares[0],
                'enfermedad_id' => $enfermedades[2], // Diabetes Tipo 2
                'notas' => 'Diagnosticado en 2020, control con dieta y medicación',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Familiar 2 (Sergio Eduardo) - tiene asma
            [
                'familiar_id' => $familiares[1],
                'enfermedad_id' => $enfermedades[3], // Asma
                'notas' => 'Asma leve, principalmente en temporada de alergia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Familiar 3 (Silvia Viviana) - tiene hipotiroidismo
            [
                'familiar_id' => $familiares[2],
                'enfermedad_id' => $enfermedades[6], // Hipotiroidismo
                'notas' => 'Detectado en 2019, tratamiento con Levotiroxina',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        
        DB::table('familiar_enfermedad')->insert($data);
    }
}
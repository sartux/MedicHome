<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdenMedicaSeeder extends Seeder
{
    public function run()
    {
        // Obtener los IDs de los familiares existentes
        $familiares = DB::table('familiares')->select('id')->get();
        
        if ($familiares->isEmpty()) {
            echo "No hay familiares en la base de datos. Por favor, ejecute el FamiliarSeeder primero.\n";
            return;
        }
        
        // Mapeamos los IDs para tener una referencia fácil
        $familiarIds = $familiares->pluck('id')->toArray();
        $familiar1Id = $familiarIds[0] ?? null;
        $familiar2Id = $familiarIds[1] ?? null;
        $familiar3Id = $familiarIds[2] ?? null;
        
        // Verificamos que tengamos todos los IDs necesarios
        if (!$familiar1Id || !$familiar2Id || !$familiar3Id) {
            echo "No hay suficientes familiares en la base de datos. Se necesitan al menos 3.\n";
            return;
        }
        
        // Órdenes médicas para diferentes familiares
        DB::table('ordenes_medicas')->insert([
            // Órdenes para el familiar 1
            [
                'Familiar_id' => $familiar1Id,
                'CATA_Especialidad' => 51, // Oncología
                'Procedimiento' => 'Consulta de seguimiento',
                'Fecha_Resetada' => Carbon::now()->subDays(30),
                'Medico_Reseta' => 'Dr. Juan Pérez',
                'Centro_Medico' => 'Hospital Universitario',
                'Ciudad' => 'Bogotá',
                'Pre_requisitos' => 'Llevar exámenes anteriores',
                'Observaciones' => 'Paciente con hipertensión controlada',
                'CATA_Estado' => 41, // Activo
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Familiar_id' => $familiar1Id,
                'CATA_Especialidad' => 54, // Cardiología
                'Procedimiento' => 'Electrocardiograma',
                'Fecha_Resetada' => Carbon::now()->subDays(15),
                'Medico_Reseta' => 'Dra. María González',
                'Centro_Medico' => 'Clínica del Corazón',
                'Ciudad' => 'Bogotá',
                'Pre_requisitos' => 'Ayuno de 4 horas',
                'Observaciones' => 'Control rutinario por antecedentes de arritmia',
                'CATA_Estado' => 41, // Activo
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Órdenes para el familiar 2
            [
                'Familiar_id' => $familiar2Id,
                'CATA_Especialidad' => 53, // Pediatría
                'Procedimiento' => 'Control anual',
                'Fecha_Resetada' => Carbon::now()->subDays(7),
                'Medico_Reseta' => 'Dr. Roberto Silva',
                'Centro_Medico' => 'Centro Médico La Esperanza',
                'Ciudad' => 'Medellín',
                'Pre_requisitos' => null,
                'Observaciones' => 'Paciente en buen estado general',
                'CATA_Estado' => 41, // Activo
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Órdenes para el familiar 3
            [
                'Familiar_id' => $familiar3Id,
                'CATA_Especialidad' => 52, // Dermatología
                'Procedimiento' => 'Revisión de lunar',
                'Fecha_Resetada' => Carbon::now()->subDays(45),
                'Medico_Reseta' => 'Dra. Carolina Díaz',
                'Centro_Medico' => 'Instituto Dermatológico',
                'Ciudad' => 'Cali',
                'Pre_requisitos' => null,
                'Observaciones' => 'Seguimiento de cambios en lunar del brazo derecho',
                'CATA_Estado' => 41, // Activo
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Familiar_id' => $familiar3Id,
                'CATA_Especialidad' => 51, // Oncología
                'Procedimiento' => 'Mamografía de control',
                'Fecha_Resetada' => Carbon::now()->subMonths(2),
                'Medico_Reseta' => 'Dr. Andrés Martínez',
                'Centro_Medico' => 'Centro Oncológico Nacional',
                'Ciudad' => 'Bogotá',
                'Pre_requisitos' => 'No usar desodorante el día del examen',
                'Observaciones' => 'Control preventivo anual',
                'CATA_Estado' => 42, // Inactivo (ya se realizó)
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
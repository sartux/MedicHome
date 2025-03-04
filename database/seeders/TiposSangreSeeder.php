<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposSangreSeeder extends Seeder
{
    public function run()
    {
        // Asumiendo que el ID del catálogo para tipos de sangre es 6
        // Primero, crear el catálogo si no existe
        DB::table('catalogos')->insertOrIgnore([
            ['id' => 6, 'Codigo' => 6, 'nombre' => 'Tipo de Sangre']
        ]);
        
        // Insertar los valores del catálogo
        DB::table('valor_catalogos')->insertOrIgnore([
            ['catalogos_Codigo' => 6, 'Codigo' => 61, 'Valor1' => 'O+', 'Valor2' => 'O Positivo', 'Valor3' => null],
            ['catalogos_Codigo' => 6, 'Codigo' => 62, 'Valor1' => 'O-', 'Valor2' => 'O Negativo', 'Valor3' => null],
            ['catalogos_Codigo' => 6, 'Codigo' => 63, 'Valor1' => 'A+', 'Valor2' => 'A Positivo', 'Valor3' => null],
            ['catalogos_Codigo' => 6, 'Codigo' => 64, 'Valor1' => 'A-', 'Valor2' => 'A Negativo', 'Valor3' => null],
            ['catalogos_Codigo' => 6, 'Codigo' => 65, 'Valor1' => 'B+', 'Valor2' => 'B Positivo', 'Valor3' => null],
            ['catalogos_Codigo' => 6, 'Codigo' => 66, 'Valor1' => 'B-', 'Valor2' => 'B Negativo', 'Valor3' => null],
            ['catalogos_Codigo' => 6, 'Codigo' => 67, 'Valor1' => 'AB+', 'Valor2' => 'AB Positivo', 'Valor3' => null],
            ['catalogos_Codigo' => 6, 'Codigo' => 68, 'Valor1' => 'AB-', 'Valor2' => 'AB Negativo', 'Valor3' => null],
        ]);
    }
}
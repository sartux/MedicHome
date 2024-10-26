<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValorCatalogosSeeder extends Seeder
{
    public function run()
    {
        DB::table('valor_catalogos')->insert([
            // Género
            ['catalogos_Codigo' => 1, 'Codigo' => 11, 'Valor1' => 'Masculino', 'Valor2' => 'M', 'Valor3' => null],
            ['catalogos_Codigo' => 1, 'Codigo' => 12, 'Valor1' => 'Femenino', 'Valor2' => 'F', 'Valor3' => null],
            
            // Presentación
            ['catalogos_Codigo' => 2, 'Codigo' => 21, 'Valor1' => 'Tabletas', 'Valor2' => '30', 'Valor3' => null],
            ['catalogos_Codigo' => 2, 'Codigo' => 22, 'Valor1' => 'Jarabe', 'Valor2' => '120ml', 'Valor3' => null],
            ['catalogos_Codigo' => 2, 'Codigo' => 23, 'Valor1' => 'Inyección', 'Valor2' => '1ml', 'Valor3' => null],
            ['catalogos_Codigo' => 2, 'Codigo' => 24, 'Valor1' => 'Cápsulas', 'Valor2' => '15', 'Valor3' => null],

            // Uso
            ['catalogos_Codigo' => 3, 'Codigo' => 30, 'Valor1' => 'No Aplica', 'Valor2' => null, 'Valor3' => null],
            ['catalogos_Codigo' => 3, 'Codigo' => 31, 'Valor1' => 'Otico', 'Valor2' => null, 'Valor3' => null],
            ['catalogos_Codigo' => 3, 'Codigo' => 32, 'Valor1' => 'Oral', 'Valor2' => null, 'Valor3' => null],
            ['catalogos_Codigo' => 3, 'Codigo' => 33, 'Valor1' => 'Tópico', 'Valor2' => null, 'Valor3' => null],

            // Estado
            ['catalogos_Codigo' => 4, 'Codigo' => 41, 'Valor1' => 'Activo', 'Valor2' => null, 'Valor3' => null],
            ['catalogos_Codigo' => 4, 'Codigo' => 42, 'Valor1' => 'Inactivo', 'Valor2' => null, 'Valor3' => null],

            // Especialidad
            ['catalogos_Codigo' => 5, 'Codigo' => 51, 'Valor1' => 'Oncología', 'Valor2' => null, 'Valor3' => null],
            ['catalogos_Codigo' => 5, 'Codigo' => 52, 'Valor1' => 'Dermatología', 'Valor2' => null, 'Valor3' => null],
            ['catalogos_Codigo' => 5, 'Codigo' => 53, 'Valor1' => 'Pediatría', 'Valor2' => null, 'Valor3' => null],
            ['catalogos_Codigo' => 5, 'Codigo' => 54, 'Valor1' => 'Cardiología', 'Valor2' => null, 'Valor3' => null]
        ]);
    }
}

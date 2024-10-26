<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama a cada seeder aquí
        $this->call([
            CatalogosSeeder::class,
            ValorCatalogosSeeder::class,
            FamiliarSeeder::class,
            MedicamentosSeeder::class,
            HistorialMedicamentoSeeder::class,
            OrdenMedicaSeeder::class,
            CitaMedicaSeeder::class,
            DocumentosSeeder::class,
        ]);
    }
}

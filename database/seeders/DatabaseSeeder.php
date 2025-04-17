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
            UserSeeder::class,
            CatalogosSeeder::class,
            ValorCatalogosSeeder::class,
            TiposSangreSeeder::class,
            EnfermedadesSeeder::class,
            AlergiasSeeder::class,
            FamiliarSeeder::class,
            FamiliarEnfermedadSeeder::class,
            FamiliarAlergiaSeeder::class,
            MedicamentosSeeder::class,
            HistorialMedicamentoSeeder::class,
            OrdenMedicaSeeder::class,
            CitaMedicaSeeder::class,
            DocumentosSeeder::class,


        ]);
    }
}

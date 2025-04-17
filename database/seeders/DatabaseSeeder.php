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
        $this->call([
            CatalogosSeeder::class,        // Primero: categorías base
            ValorCatalogosSeeder::class,   // Segundo: valores que dependen de categorías
            TiposSangreSeeder::class,      // Tercero: otros catálogos específicos
            NucleoFamiliarSeeder::class, // Cuarto: núcleo familiar (depende de catálogos)
            SuperAdminSeeder::class,       // Quinto: super administrador (depende de núcleo familiar)
            UserSeeder::class,             // Cuarto: usuarios
            EnfermedadesSeeder::class,     // Quinto: enfermedades base
            AlergiasSeeder::class,         // Sexto: alergias base
            FamiliarSeeder::class,         // Séptimo: familiares (dependen de catálogos)
            MedicamentosSeeder::class,     // Octavo: medicamentos (dependen de catálogos)
            HistorialMedicamentoSeeder::class, // Depende de medicamentos y familiares
            OrdenMedicaSeeder::class,      // Depende de familiares
            CitaMedicaSeeder::class,       // Depende de órdenes médicas
            DocumentosSeeder::class,       // Último: documentos (dependen de todo lo anterior)
            // Añade aquí un NucleoFamiliarSeeder si lo necesitas
        ]);
    }
}

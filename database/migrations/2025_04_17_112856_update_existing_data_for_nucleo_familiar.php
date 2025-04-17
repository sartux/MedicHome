// Archivo: database/migrations/2025_04_16_000002_update_existing_data_for_nucleo_familiar.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Solo ejecutar si no hay núcleos familiares todavía
        if (DB::table('nucleo_familiares')->count() == 0) {
            // Crear un núcleo familiar por defecto
            $nucleoId = DB::table('nucleo_familiares')->insertGetId([
                'codigo' => 'DEFAULT',
                'nombre' => 'Núcleo Familiar por Defecto',
                'cant_familiares' => 100, // Un número grande para acomodar los existentes
                'fecha_crea' => now(),
                'CATA_Estado' => 41, // Activo
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Actualizar todos los familiares existentes
            DB::table('familiares')->whereNull('nucleo_familiar_id')->update([
                'nucleo_familiar_id' => $nucleoId
            ]);
            
            // Convertir el primer usuario en admin de núcleo
            $firstUser = DB::table('users')->first();
            if ($firstUser) {
                DB::table('users')->where('id', $firstUser->id)->update([
                    'nucleo_familiar_id' => $nucleoId,
                    'is_nucleo_admin' => true,
                ]);
            }
        }
    }

    public function down(): void
    {
        // No hacer nada, ya que revertir esto podría causar pérdida de datos
    }
};
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class NucleoFamiliarSeeder extends Seeder
{
    public function run()
    {
        // Crear el núcleo familiar de ejemplo
        $nucleoId = DB::table('nucleo_familiars')->insertGetId([
            'codigo' => 'AR01',
            'nombre' => 'Arboleda',
            'cant_familiares' => 3,
            'fecha_crea' => '2024-01-01',
            'fecha_cierre' => null,
            'CATA_Estado' => 41, // Activo
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Crear el usuario administrador del núcleo
        DB::table('users')->insert([
            'name' => 'Admin Arboleda',
            'email' => 'admin.arboleda@example.com',
            'password' => Hash::make('password123'),
            'nucleo_familiar_id' => $nucleoId,
            'is_admin' => true,
            'is_superadmin' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Actualizar los familiares existentes para asociarlos al núcleo
        DB::table('familiares')->where('id', 1)->update(['nucleo_familiar_id' => $nucleoId]);
        DB::table('familiares')->where('id', 2)->update(['nucleo_familiar_id' => $nucleoId]);
        DB::table('familiares')->where('id', 3)->update(['nucleo_familiar_id' => $nucleoId]);
        
        // Crear un segundo núcleo como ejemplo
        $nucleoId2 = DB::table('nucleo_familiars')->insertGetId([
            'codigo' => 'GB02',
            'nombre' => 'García Betancourt',
            'cant_familiares' => 5,
            'fecha_crea' => '2024-02-15',
            'fecha_cierre' => null,
            'CATA_Estado' => 42, // Inactivo
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Crear el usuario administrador del segundo núcleo
        DB::table('users')->insert([
            'name' => 'Admin García',
            'email' => 'admin.garcia@example.com',
            'password' => Hash::make('password123'),
            'nucleo_familiar_id' => $nucleoId2,
            'is_admin' => true,
            'is_superadmin' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
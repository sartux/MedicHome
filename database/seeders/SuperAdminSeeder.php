<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Crear un usuario superadmin
        DB::table('users')->insert([
            'name' => 'Super Administrador',
            'email' => 'superadmin@medichome.com',
            'password' => Hash::make('Tame892*'),
            'is_admin' => 1,
            'is_superadmin' => 1,
            'nucleo_familiar_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
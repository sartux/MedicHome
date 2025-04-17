<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario super administrador
        User::create([
            'name' => 'Super Administrador',
            'email' => 'superadmin@medichome.com',
            'password' => Hash::make('superadmin123'),
            'is_super_admin' => true,
            'is_nucleo_admin' => false,
            'nucleo_familiar_id' => null, // No pertenece a ningún núcleo
        ]);
    }
}

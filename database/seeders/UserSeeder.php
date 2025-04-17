<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario superadmin
        User::create([
            'name' => 'Superadministrador',
            'email' => 'superadmin@medichome.net',
            'password' => Hash::make('Tame892*'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'is_superadmin' => true,
        ]);

        // Crear un usuario normal (que luego será asociado a un núcleo)
        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@medichome.net',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_admin' => false,
            'is_superadmin' => false,
        ]);

        // Crear un usuario para servicio técnico
        User::create([
            'name' => 'Soporte',
            'email' => 'soporte@medichome.net',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'is_superadmin' => false,
        ]);
    }
}
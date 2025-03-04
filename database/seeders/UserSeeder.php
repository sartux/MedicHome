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
        // Crear un usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@Codigo0.net',
            'password' => Hash::make('Tame892*'),
            'email_verified_at' => now(),
        ]);

        // Crear un usuario normal
        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@Codigo0.net',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Crear un usuario para servicio técnico
        User::create([
            'name' => 'Soporte',
            'email' => 'soporte@Codigo0.net',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Opcionalmente, puedes crear más usuarios con el Factory si tienes muchos
        // User::factory(10)->create();
    }
}
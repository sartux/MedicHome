<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliarSeeder extends Seeder
{
    public function run()
    {
        DB::table('familiares')->insert([
           
            [
                'nombre' => 'Pedro Antonio',
                'apellido' => 'Perez',
                'fecha_nacimiento' => '1936-06-14',
                'CATA_genero' => 11,
                'CATA_tipo_sangre' => 63,
                'correo' => 'ppa@gmail.com',
                'telefono' => '+573003487942',
                'contacto_nombre1' => 'Armando Casas',
                'contacto_telefono1' => '+573053435763',   
                'contacto_nombre2' => 'Ana Francisca',
                'contacto_telefono2' => '+573063487942',
                'CATA_Estado' => 41
            ],
            [
                'nombre' => 'Soila',
                'apellido' => 'Perez',
                'fecha_nacimiento' => '1979-03-09',
                'CATA_tipo_sangre' => 62,
                'CATA_genero' => 11,
                'correo' => 'soilaP@gasd.com',
                'telefono' => '+573013435763',
                'contacto_nombre1' => 'Carlos Perez',
                'contacto_telefono1' => '+573003487942',
                'contacto_nombre2' => 'Oscar Silvio',
                'contacto_telefono2' => '+573063487942',
                'CATA_Estado' => 41
            ],
            [
                'nombre' => 'Armando',
                'apellido' => 'Bronca Segura',
                'fecha_nacimiento' => '1975-10-01',
                'CATA_tipo_sangre' => 61,
                'CATA_genero' => 12,
                'correo' => 'Arqui@info.com',
                'telefono' => '+57333333333',
                'contacto_nombre1' => 'Oscar Silvio',
                'contacto_telefono1' => '+573003487942',
                'contacto_nombre2' => 'Sergio Eduardo',
                'contacto_telefono2' => '+573063487942',
                'CATA_Estado' => 42
            ]
            // Agrega más familiares según sea necesario
        ]);
    }
}
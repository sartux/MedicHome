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
                'nombre' => 'Oscar Silvio',
                'apellido' => 'Arboleda',
                'fecha_nacimiento' => '1936-06-14',
                'CATA_genero' => 11,
                'CATA_tipo_sangre' => 63,
                'correo' => 'oscarsa1@gmail.com',
                'telefono' => '3123487942',
                'contacto_nombre1' => 'Sergio Eduardo',
                'contacto_telefono1' => '3213435763',   
                'contacto_nombre2' => 'Silvia Viviana',
                'contacto_telefono2' => '3123487942',
                'CATA_Estado' => 41
            ],
            [
                'nombre' => 'Sergio Eduardo',
                'apellido' => 'Arboleda Villa',
                'fecha_nacimiento' => '1979-03-09',
                'CATA_tipo_sangre' => 62,
                'CATA_genero' => 11,
                'correo' => 'sarboleda@gmail.com',
                'telefono' => '3213435763',
                'contacto_nombre1' => 'Silvia Viviana',
                'contacto_telefono1' => '3123487942',
                'contacto_nombre2' => 'Oscar Silvio',
                'contacto_telefono2' => '3123487942',
                'CATA_Estado' => 41
            ],
            [
                'nombre' => 'Silvia Viviana',
                'apellido' => 'Arboleda Carrillo',
                'fecha_nacimiento' => '1975-10-01',
                'CATA_tipo_sangre' => 61,
                'CATA_genero' => 12,
                'correo' => 'bibi@info.com',
                'telefono' => '333333333',
                'contacto_nombre1' => 'Oscar Silvio',
                'contacto_telefono1' => '3123487942',
                'contacto_nombre2' => 'Sergio Eduardo',
                'contacto_telefono2' => '3213435763',
                'CATA_Estado' => 42
            ]
            // Agrega más familiares según sea necesario
        ]);
    }
}
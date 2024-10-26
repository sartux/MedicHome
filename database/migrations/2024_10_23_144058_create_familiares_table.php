<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliaresTable extends Migration
{
    public function up()
    {
        Schema::create('familiares', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->date('fecha_nacimiento');
            $table->integer('CATA_genero');
            $table->string('correo', 40);
            $table->string('telefono', 11);
            $table->integer('CATA_Estado');
            $table->timestamps();

            // Llave foránea
            $table->foreign('CATA_genero')->references('Codigo')->on('valor_catalogos');
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('familiares');
    }
};
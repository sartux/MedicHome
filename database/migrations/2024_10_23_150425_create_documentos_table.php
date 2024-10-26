<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Familiar_id');
            $table->unsignedBigInteger('OrdenMedica_id');
            $table->integer('CATA_Especialidad');
            $table->date('Fecha_documento');
            $table->integer('CATA_Estado');
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('Familiar_id')->references('id')->on('familiares');
            $table->foreign('OrdenMedica_id')->references('id')->on('ordenes_medicas');
            $table->foreign('CATA_Especialidad')->references('Codigo')->on('valor_catalogos');
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
};

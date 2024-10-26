<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasMedicasTable extends Migration
{
    public function up()
    {
        Schema::create('citas_medicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('OrdenMedica_id');
            $table->timestamp('Fecha_Hora_Cita')->nullable();
            $table->timestamps();

            // Llave foránea
            $table->foreign('OrdenMedica_id')->references('id')->on('ordenes_medicas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas_medicas');
    }
};

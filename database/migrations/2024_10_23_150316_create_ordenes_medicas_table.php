<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesMedicasTable extends Migration
{
    public function up()
    {
        Schema::create('ordenes_medicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Familiar_id');
            $table->integer('CATA_Especialidad');
            $table->string('Procedimiento', 300);
            $table->date('Fecha_Resetada');
            $table->string('Medico_Reseta', 60);
            $table->string('Centro_Medico', 60);
            $table->string('Ciudad', 50);
            $table->string('Pre_requisitos', 400)->nullable();
            $table->string('Observaciones', 400);
            $table->integer('CATA_Estado');
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('Familiar_id')->references('id')->on('familiares');
            $table->foreign('CATA_Especialidad')->references('Codigo')->on('valor_catalogos');
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes_medicas');
    }
}
;

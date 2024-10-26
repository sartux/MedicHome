<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 40);
            $table->string('Composicion', 80);
            $table->integer('CATA_presentacion');
            $table->integer('CATA_Uso');
            $table->integer('CATA_Especialidad');
            $table->string('Observaciones', 400);
            $table->integer('CATA_Estado');
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('CATA_presentacion')->references('Codigo')->on('valor_catalogos');
            $table->foreign('CATA_Uso')->references('Codigo')->on('valor_catalogos');
            $table->foreign('CATA_Especialidad')->references('Codigo')->on('valor_catalogos');
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
}
;

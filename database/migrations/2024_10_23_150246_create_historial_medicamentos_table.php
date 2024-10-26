<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialMedicamentosTable extends Migration
{
    public function up()
    {
        Schema::create('historial_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Familiar_id');
            $table->unsignedBigInteger('medicamento_id');
            $table->string('descripcion_tratamiento', 400);
            $table->string('dosis', 100);
            $table->date('fecha_inicio');
            $table->date('fecha_final')->nullable();
            $table->integer('CATA_Estado');
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('Familiar_id')->references('id')->on('familiares');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos');
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_medicamentos');
    }
}
;

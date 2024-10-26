<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorCatalogosTable extends Migration
{
    public function up()
    {
        Schema::create('valor_catalogos', function (Blueprint $table) {
            $table->id();
            $table->integer('Codigo')->unique(); // Asegura que no haya códigos duplicados
            $table->integer('catalogos_Codigo');
            $table->string('Valor1', 40);
            $table->string('Valor2', 40)->nullable();
            $table->string('Valor3', 40)->nullable();
            $table->timestamps();

           // Llave foránea
           $table->foreign('catalogos_Codigo')->references('Codigo')->on('catalogos');

        });
    }

    public function down()
    {
        Schema::dropIfExists('valor_catalogos');
    }
}
;

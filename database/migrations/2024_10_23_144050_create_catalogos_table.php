<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogosTable extends Migration
{
    public function up()
    {
        Schema::create('catalogos', function (Blueprint $table) {
            $table->id();
            $table->integer('Codigo')->unique(); // Asegura que no haya códigos duplicados
            $table->string('nombre', 40);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catalogos');
    }
}
;

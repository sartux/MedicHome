<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->integer('CATA_Estado')->default(41); // Asumiendo que 41 es "Activo"
            $table->timestamps();
            
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enfermedades');
    }
};
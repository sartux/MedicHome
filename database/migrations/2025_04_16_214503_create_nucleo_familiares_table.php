<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nucleo_familiars', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique();
            $table->string('nombre', 100);
            $table->integer('cant_familiares');
            $table->date('fecha_crea');
            $table->date('fecha_cierre')->nullable();
            $table->integer('CATA_Estado');
            $table->timestamps();
            
            // Referencia al catálogo de estados
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nucleo_familiars');
    }
};
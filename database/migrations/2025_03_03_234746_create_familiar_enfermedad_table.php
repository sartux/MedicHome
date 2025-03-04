<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('familiar_enfermedad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familiar_id');
            $table->unsignedBigInteger('enfermedad_id');
            $table->text('notas')->nullable();
            $table->timestamps();
            
            $table->foreign('familiar_id')->references('id')->on('familiares')->onDelete('cascade');
            $table->foreign('enfermedad_id')->references('id')->on('enfermedades')->onDelete('cascade');
            
            // Evitar duplicados
            $table->unique(['familiar_id', 'enfermedad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('familiar_enfermedad');
    }
};
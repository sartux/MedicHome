<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('familiar_alergia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familiar_id');
            $table->unsignedBigInteger('alergia_id');
            $table->text('notas')->nullable();
            $table->timestamps();
            
            $table->foreign('familiar_id')->references('id')->on('familiares')->onDelete('cascade');
            $table->foreign('alergia_id')->references('id')->on('alergias')->onDelete('cascade');
            
            // Evitar duplicados
            $table->unique(['familiar_id', 'alergia_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('familiar_alergia');
    }
};
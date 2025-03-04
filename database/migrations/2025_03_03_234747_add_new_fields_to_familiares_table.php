<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('familiares', function (Blueprint $table) {
            $table->integer('CATA_tipo_sangre')->nullable()->after('CATA_genero');
            $table->string('contacto_nombre1', 100)->nullable()->after('telefono');
            $table->string('contacto_telefono1', 20)->nullable()->after('contacto_nombre1');
            $table->string('contacto_nombre2', 100)->nullable()->after('contacto_telefono1');
            $table->string('contacto_telefono2', 20)->nullable()->after('contacto_nombre2');
            
            // Añadir la relación con tipo de sangre
            $table->foreign('CATA_tipo_sangre')->references('Codigo')->on('valor_catalogos');
        });
    }

    public function down(): void
    {
        Schema::table('familiares', function (Blueprint $table) {
            $table->dropForeign(['CATA_tipo_sangre']);
            $table->dropColumn([
                'CATA_tipo_sangre',
                'contacto_nombre1',
                'contacto_telefono1',
                'contacto_nombre2',
                'contacto_telefono2'
            ]);
        });
    }
};
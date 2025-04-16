// Archivo: database/migrations/2025_04_16_000001_create_nucleo_familiares_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nucleo_familiares', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique();
            $table->string('nombre', 50);
            $table->integer('cant_familiares');
            $table->date('fecha_crea');
            $table->date('fecha_cierre')->nullable();
            $table->integer('CATA_Estado');
            $table->timestamps();
            
            $table->foreign('CATA_Estado')->references('Codigo')->on('valor_catalogos');
        });
        
        // Agregar la columna nucleo_familiar_id a la tabla usuarios
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('nucleo_familiar_id')->nullable();
            $table->boolean('is_nucleo_admin')->default(false);
            $table->boolean('is_super_admin')->default(false);
            
            $table->foreign('nucleo_familiar_id')->references('id')->on('nucleo_familiares');
        });
        
        // Agregar la columna nucleo_familiar_id a la tabla familiares
        Schema::table('familiares', function (Blueprint $table) {
            $table->unsignedBigInteger('nucleo_familiar_id')->nullable();
            
            $table->foreign('nucleo_familiar_id')->references('id')->on('nucleo_familiares');
        });
    }

    public function down(): void
    {
        Schema::table('familiares', function (Blueprint $table) {
            $table->dropForeign(['nucleo_familiar_id']);
            $table->dropColumn('nucleo_familiar_id');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['nucleo_familiar_id']);
            $table->dropColumn(['nucleo_familiar_id', 'is_nucleo_admin', 'is_super_admin']);
        });
        
        Schema::dropIfExists('nucleo_familiares');
    }
};
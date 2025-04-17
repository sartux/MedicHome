<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('familiares', function (Blueprint $table) {
            $table->unsignedBigInteger('nucleo_familiar_id')->nullable()->after('id');
            
            $table->foreign('nucleo_familiar_id')->references('id')->on('nucleo_familiars');
        });
    }

    public function down(): void
    {
        Schema::table('familiares', function (Blueprint $table) {
            $table->dropForeign(['nucleo_familiar_id']);
            $table->dropColumn('nucleo_familiar_id');
        });
    }
};
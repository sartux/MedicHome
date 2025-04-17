<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('nucleo_familiar_id')->nullable()->after('email');
            $table->boolean('is_admin')->default(false)->after('nucleo_familiar_id');
            $table->boolean('is_superadmin')->default(false)->after('is_admin');
            
            $table->foreign('nucleo_familiar_id')->references('id')->on('nucleo_familiars');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['nucleo_familiar_id']);
            $table->dropColumn(['nucleo_familiar_id', 'is_admin', 'is_superadmin']);
        });
    }
};
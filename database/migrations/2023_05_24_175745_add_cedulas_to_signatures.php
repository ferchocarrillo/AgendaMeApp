<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->string('cedula1')->default('');
        });
        Schema::table('signatures', function (Blueprint $table) {
            $table->string('cedula2')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->dropColumn('cedula1');
        });
        Schema::table('signatures', function (Blueprint $table) {
            $table->dropColumn('cedula2');
        });
    }
};

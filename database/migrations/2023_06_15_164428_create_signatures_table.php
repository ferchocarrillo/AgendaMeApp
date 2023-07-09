<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doctor');
            $table->string('paciente');
            $table->string('procedureType');
            $table->string('tratamiento');
            $table->date('fecha');
            $table->time('hora');
            $table->string('indicaciones');
            $table->string('signature');
            $table->bigInteger('cedula1');
            $table->string('signature2')->nullable();
            $table->bigInteger('cedula2')->nullable();
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')
            ->on('appointments')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};

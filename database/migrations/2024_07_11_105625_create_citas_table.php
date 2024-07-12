<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pacienteId')->nullable();
            $table->unsignedInteger('medicoId')->nullable();
            $table->dateTime('fechaHora')->nullable();
            $table->unsignedInteger('estadoId')->nullable();
            $table->unsignedInteger('horarioId')->nullable();
            $table->integer('duracion')->default(30);
            $table->timestamps();

            $table->foreign('pacienteId')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
            $table->foreign('estadoId')->references('id')->on('estados_cita')->onDelete('set null');
            $table->foreign('horarioId')->references('id')->on('horarios_medicos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}

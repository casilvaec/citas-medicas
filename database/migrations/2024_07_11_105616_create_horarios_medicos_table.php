<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosMedicosTable extends Migration
{
    public function up()
    {
        Schema::create('horarios_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('medicoId')->nullable();
            $table->integer('diaSemana')->nullable();
            $table->time('horaInicio')->nullable();
            $table->time('horaFin')->nullable();
            $table->timestamps();

            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('horarios_medicos');
    }
}

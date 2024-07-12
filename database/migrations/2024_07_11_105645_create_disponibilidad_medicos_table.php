<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadMedicosTable extends Migration
{
    public function up()
    {
        Schema::create('disponibilidad_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('medicoId')->nullable();
            $table->date('fecha')->nullable();
            $table->time('horaInicio')->nullable();
            $table->time('horaFin')->nullable();
            $table->boolean('disponible')->default(1);
            $table->timestamps();

            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('disponibilidad_medicos');
    }
}

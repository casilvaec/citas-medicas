<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadesMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidades_medicas', function (Blueprint $table) {
            $table->id(); // ID de la disponibilidad
            $table->unsignedBigInteger('medico_id'); // ID del médico
            $table->date('fecha'); // Fecha de la disponibilidad
            $table->time('hora_inicio'); // Hora de inicio de la disponibilidad
            $table->time('hora_fin'); // Hora de fin de la disponibilidad
            $table->boolean('reservado')->default(false); // Indicador de si el horario ha sido reservado
            $table->timestamps(); // created_at y updated_at

            // * Relaciones
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');

            // * Llave única para asegurar que no se dupliquen las disponibilidades
            $table->unique(['medico_id', 'fecha', 'hora_inicio']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disponibilidades_medicas');
    }
}

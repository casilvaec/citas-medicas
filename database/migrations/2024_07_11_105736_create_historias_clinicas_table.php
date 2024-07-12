<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasClinicasTable extends Migration
{
    public function up()
    {
        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pacienteId')->nullable();
            $table->dateTime('fechaHora')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('pacienteId')->references('id')->on('pacientes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historias_clinicas');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialidadesMedicasTable extends Migration
{
    public function up()
    {
        Schema::create('especialidades_medicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable(false); // Hacer que el nombre no pueda ser nulo
            $table->text('descripcion')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('especialidades_medicas');
    }
}

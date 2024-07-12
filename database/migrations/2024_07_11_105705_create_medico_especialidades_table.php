<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoEspecialidadesTable extends Migration
{
    public function up()
    {
        Schema::create('medico_especialidades', function (Blueprint $table) {
            $table->unsignedInteger('medicoId');
            $table->unsignedInteger('especialidadId');
            $table->primary(['medicoId', 'especialidadId']);
            $table->timestamps();

            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
            $table->foreign('especialidadId')->references('id')->on('especialidades_medicas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medico_especialidades');
    }
}

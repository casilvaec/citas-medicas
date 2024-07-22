<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoEspecialidadesTable extends Migration
{
    public function up()
    {
    //     Schema::create('medico_especialidades', function (Blueprint $table) {
    //         $table->foreignId('medicoId')->constrained('medicos')->onDelete('cascade');
    //         $table->foreignId('especialidadId')->constrained('especialidades_medicas')->onDelete('cascade');
    //         $table->timestamps();

    //         $table->primary(['medicoId', 'especialidadId']);
    //     });
    }

    public function down()
    {
        Schema::dropIfExists('medico_especialidades');
    }
}

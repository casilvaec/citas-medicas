<?php

// database/migrations/xxxx_xx_xx_create_consultorio_medico_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultorioMedicoTable extends Migration
{
    public function up()
    {
        Schema::create('consultorio_medico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultorioId')->constrained('consultorios');
            $table->foreignId('medicoId')->constrained('users');
            $table->date('fecha_asignacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultorio_medico');
    }
}

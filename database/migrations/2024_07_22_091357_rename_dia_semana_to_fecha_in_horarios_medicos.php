<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDiaSemanaToFechaInHorariosMedicos extends Migration
{
    public function up()
    {
        Schema::table('horarios_medicos', function (Blueprint $table) {
            $table->renameColumn('diaSemana', 'fecha');
        });
    }

    public function down()
    {
        Schema::table('horarios_medicos', function (Blueprint $table) {
            $table->renameColumn('fecha', 'diaSemana');
        });
    }
}

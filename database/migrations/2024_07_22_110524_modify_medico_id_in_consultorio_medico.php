<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMedicoIdInConsultorioMedico extends Migration
{
    public function up()
    {
        Schema::table('consultorio_medico', function (Blueprint $table) {
            $table->unsignedBigInteger('medico_id')->change();
        });
    }

    public function down()
    {
        Schema::table('consultorio_medico', function (Blueprint $table) {
            $table->unsignedInteger('medico_id')->change();
        });
    }
}


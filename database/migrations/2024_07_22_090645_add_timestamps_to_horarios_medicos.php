<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToHorariosMedicos extends Migration
{
    public function up()
    {
        Schema::table('horarios_medicos', function (Blueprint $table) {
            $table->timestamps(); // Agregar created_at y updated_at
        });
    }

    public function down()
    {
        Schema::table('horarios_medicos', function (Blueprint $table) {
            $table->dropTimestamps(); // Eliminar created_at y updated_at
        });
    }
}

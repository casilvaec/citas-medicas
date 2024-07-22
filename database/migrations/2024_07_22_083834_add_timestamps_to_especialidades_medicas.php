<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToEspecialidadesMedicas extends Migration
{
    public function up()
    {
        Schema::table('especialidades_medicas', function (Blueprint $table) {
            $table->timestamps(); // Agregar created_at y updated_at
        });
    }

    public function down()
    {
        Schema::table('especialidades_medicas', function (Blueprint $table) {
            $table->dropTimestamps(); // Eliminar created_at y updated_at
        });
    }
}

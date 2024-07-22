<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsuarioIdInMedicosTable extends Migration
{
    public function up()
    {
        Schema::table('medicos', function (Blueprint $table) {
            // Cambiar la columna usuarioId a unsigned
            $table->unsignedInteger('usuarioId')->change();
        });
    }

    public function down()
    {
        Schema::table('medicos', function (Blueprint $table) {
            $table->integer('usuarioId')->change();
        });
    }
}

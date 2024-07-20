<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixForeignKeyInMedicosTable extends Migration
{
    public function up()
    {
        Schema::table('medicos', function (Blueprint $table) {
            // Eliminar la clave foránea incorrecta
            $table->dropForeign(['usuarioId']);

            // Agregar la nueva clave foránea correcta
            $table->foreign('usuarioId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('medicos', function (Blueprint $table) {
            // Revertir los cambios si es necesario
            $table->dropForeign(['usuarioId']);
            $table->foreign('usuarioId')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }
}

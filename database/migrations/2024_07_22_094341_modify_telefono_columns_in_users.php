<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTelefonoColumnsInUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('telefono', 'telefonoConvencional'); // Renombrar columna telefono a telefonoConvencional
            $table->string('telefonoCelular')->nullable(); // Agregar columna telefonoCelular
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('telefonoConvencional', 'telefono'); // Revertir el cambio de nombre de columna
            $table->dropColumn('telefonoCelular'); // Eliminar columna telefonoCelular
        });
    }
}

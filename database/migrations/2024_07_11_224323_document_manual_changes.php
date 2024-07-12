<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocumentManualChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Documentar los cambios manuales realizados en la base de datos
        Schema::table('users', function (Blueprint $table) {
            // Ya se ha renombrado 'telefono' a 'telefonoConvencional'
            // Ya se ha añadido 'telefonoCelular'
            // Ya se ha renombrado 'estado' a 'estadoId'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revertir los cambios manuales realizados
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la columna 'telefonoCelular'
            $table->dropColumn('telefonoCelular');

            // Renombrar la columna 'telefonoConvencional' a 'telefono'
            $table->renameColumn('telefonoConvencional', 'telefono');

            // Renombrar la columna 'estadoId' a 'estado'
            $table->renameColumn('estadoId', 'estado');
        });
    }
}

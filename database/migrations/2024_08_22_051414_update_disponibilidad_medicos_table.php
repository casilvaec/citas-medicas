<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDisponibilidadMedicosTable extends Migration
{
    public function up()
    {
        Schema::table('disponibilidad_medicos', function (Blueprint $table) {
            // Cambiar la columna medicoId para asegurar que sea unsigned y no nullable
            $table->unsignedInteger('medicoId')->nullable(false)->change();

            // Verificar si la columna 'disponible' ya existe y configurarla adecuadamente
            if (Schema::hasColumn('disponibilidad_medicos', 'disponible')) {
                $table->boolean('disponible')->default(1)->change();
            } else {
                $table->boolean('disponible')->default(1);
            }

            // Crear la clave foránea sin causar errores
            // Verificar si la clave foránea ya existe antes de intentar agregarla
            if (!Schema::hasColumn('disponibilidad_medicos', 'medicoId') ||
                !Schema::hasColumn('medicos', 'id')) {
                $table->foreign('medicoId')
                      ->references('id')
                      ->on('medicos')
                      ->onDelete('cascade');
            }

            // Agregar índice compuesto para optimización
            $table->index(['medicoId', 'fecha', 'horaInicio']);
        });
    }

    public function down()
    {
        Schema::table('disponibilidad_medicos', function (Blueprint $table) {
            // Eliminar el índice compuesto
            $table->dropIndex(['medicoId', 'fecha', 'horaInicio']);

            // Eliminar la clave foránea
            $table->dropForeign(['medicoId']);
        });
    }
}


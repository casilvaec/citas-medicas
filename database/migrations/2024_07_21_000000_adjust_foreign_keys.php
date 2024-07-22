<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustForeignKeys extends Migration
{
    public function up()
    {
        // Ajuste de claves foráneas para la tabla 'usuarios'
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreign('tipoIdentificacionId')->references('id')->on('tipos_identificacion')->onDelete('set null');
            $table->foreign('generoId')->references('id')->on('generos')->onDelete('set null');
            $table->foreign('ciudadResidenciaId')->references('id')->on('ciudades')->onDelete('set null');
        });

        // Ajuste de claves foráneas para la tabla 'pacientes'
        Schema::table('pacientes', function (Blueprint $table) {
            $table->foreign('usuarioId')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // Ajuste de claves foráneas para la tabla 'medicos'
        Schema::table('medicos', function (Blueprint $table) {
            $table->foreign('usuarioId')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // Ajuste de claves foráneas para la tabla 'horarios_medicos'
        Schema::table('horarios_medicos', function (Blueprint $table) {
            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
        });

        // Ajuste de claves foráneas para la tabla 'citas'
        Schema::table('citas', function (Blueprint $table) {
            $table->foreign('pacienteId')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
            $table->foreign('especialidadId')->references('id')->on('especialidades_medicas')->onDelete('cascade');
        });

        // Agregar aquí cualquier otra tabla que necesite ajuste de claves foráneas
    }

    public function down()
    {
        // Código para revertir los cambios (opcional)
    }
}

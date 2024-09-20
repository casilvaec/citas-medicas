<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 
     *
     * Aquí definimos la estructura de la tabla 'triajes'.
     * Esta tabla almacenará los datos capturados durante el proceso de triaje médico.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triajes', function (Blueprint $table) {
            $table->id(); // * Clave primaria automática (id único para cada triaje)
            
            // TODO: Relación con la tabla 'pacientes'
            $table->unsignedInteger('pacienteId'); // * Este campo almacenará el id del paciente que se está atendiendo

            // TODO: Datos vitales capturados durante el triaje
            $table->integer('frecuenciaCardiaca'); 
            $table->integer('frecuenciaRespiratoria'); 
            $table->integer('presionArterialMin'); 
            $table->integer('presionArterialMax'); 
            $table->float('temperaturaCorporal'); 
            $table->float('saturacionOxigeno'); 
            $table->string('prioridad'); 

            // TODO: Estado de la atención y estado del registro
            $table->string('estadoAtencion')->default('en espera'); // * Se asigna automáticamente "en espera" una vez que se registra el triaje.
            $table->string('estadoRegistro')->default('activo'); // * Manejo del estado del registro (activo/inactivo).

            // * Timestamps automáticos para created_at y updated_at
            $table->timestamps();

            // TODO: Definir clave foránea para la relación con 'pacientes'
            $table->foreign('pacienteId')->references('id')->on('pacientes')->onDelete('cascade');
            // ! La opción 'cascade' asegura que si un paciente es eliminado, también se eliminarán todos los registros de triaje asociados
        });
    }

    /**
     * 
     *
     * Este método eliminará la tabla 'triajes' si se ejecuta la reversión de la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('triajes');
    }
};

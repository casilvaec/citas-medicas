<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCitasTable extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->unsignedBigInteger('especialidad_id')->after('medicoId');
            $table->date('fecha')->after('especialidad_id');
            $table->time('hora_inicio')->after('fecha');
            $table->time('hora_fin')->after('hora_inicio');
            $table->string('motivo')->after('hora_fin');
            $table->string('estado')->default('Agendada')->after('motivo');

            $table->foreign('especialidad_id')->references('id')->on('especialidades_medicas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['especialidad_id']);
            $table->dropColumn(['especialidad_id', 'fecha', 'hora_inicio', 'hora_fin', 'motivo', 'estado']);
        });
    }
}

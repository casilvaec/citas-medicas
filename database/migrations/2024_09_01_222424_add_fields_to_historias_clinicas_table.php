<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToHistoriasClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historiasclinicas', function (Blueprint $table) {
            $table->integer('citaId')->after('pacienteId')->nullable(false);
            $table->text('diagnostico')->nullable()->after('fechaHora');
            $table->text('examenes')->nullable()->after('diagnostico');
            $table->text('receta')->nullable()->after('examenes');
            $table->date('proximoControl')->nullable()->after('receta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historiasclinicas', function (Blueprint $table) {
            $table->dropColumn('citaId');
            $table->dropColumn('diagnostico');
            $table->dropColumn('examenes');
            $table->dropColumn('receta');
            $table->dropColumn('proximoControl');
        });
    }
}
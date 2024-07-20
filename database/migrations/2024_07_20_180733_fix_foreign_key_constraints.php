<?php

// database/migrations/xxxx_xx_xx_fix_foreign_key_constraints.php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixForeignKeyConstraints extends Migration
{
    public function up()
    {
        Schema::table('horarios_medicos', function (Blueprint $table) {
            $table->dropForeign(['medicoId']);
            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
        });

        Schema::table('disponibilidad_medicos', function (Blueprint $table) {
            $table->dropForeign(['medicoId']);
            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
        });

        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['medicoId']);
            $table->foreign('medicoId')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('horarios_medicos', function (Blueprint $table) {
            $table->dropForeign(['medicoId']);
        });

        Schema::table('disponibilidad_medicos', function (Blueprint $table) {
            $table->dropForeign(['medicoId']);
        });

        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['medicoId']);
        });
    }
}

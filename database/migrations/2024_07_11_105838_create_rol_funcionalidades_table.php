<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolFuncionalidadesTable extends Migration
{
    public function up()
    {
        Schema::create('rol_funcionalidades', function (Blueprint $table) {
            $table->unsignedInteger('rolId');
            $table->unsignedInteger('funcionalidadId');
            $table->primary(['rolId', 'funcionalidadId']);
            $table->timestamps();

            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('funcionalidadId')->references('id')->on('funcionalidades')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rol_funcionalidades');
    }
}

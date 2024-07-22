<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRolfuncionalidadesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('rolfuncionalidades');
    }

    public function down()
    {
        Schema::create('rolfuncionalidades', function (Blueprint $table) {
            $table->integer('rolId');
            $table->integer('funcionalidadId');
            $table->primary(['rolId', 'funcionalidadId']);
        });
    }
}


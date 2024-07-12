<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('moduloId')->nullable();
            $table->string('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('moduloId')->references('id')->on('modulos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}

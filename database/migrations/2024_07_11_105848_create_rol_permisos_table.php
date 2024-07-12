<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolPermisosTable extends Migration
{
    public function up()
    {
        Schema::create('rol_permisos', function (Blueprint $table) {
            $table->unsignedInteger('rolId');
            $table->unsignedInteger('permisoId');
            $table->primary(['rolId', 'permisoId']);
            $table->timestamps();

            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permisoId')->references('id')->on('permisos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rol_permisos');
    }
}

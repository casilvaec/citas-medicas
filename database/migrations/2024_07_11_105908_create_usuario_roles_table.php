<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioRolesTable extends Migration
{
    public function up()
    {
        Schema::create('usuario_roles', function (Blueprint $table) {
            $table->unsignedInteger('usuarioId');
            $table->unsignedInteger('rolId');
            $table->primary(['usuarioId', 'rolId']);
            $table->timestamps();

            $table->foreign('usuarioId')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_roles');
    }
}

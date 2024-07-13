<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTableCustom extends Migration
{
    public function up()
    {
     
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('correoElectronico')->unique()->nullable();
            $table->string('password')->nullable();
            $table->unsignedInteger('tipoIdentificacionId')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->unsignedInteger('generoId')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedInteger('ciudadResidenciaId')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('tipoIdentificacionId')->references('id')->on('tipos_identificacion')->onDelete('set null');
            $table->foreign('generoId')->references('id')->on('generos')->onDelete('set null');
            $table->foreign('ciudadResidenciaId')->references('id')->on('ciudades')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
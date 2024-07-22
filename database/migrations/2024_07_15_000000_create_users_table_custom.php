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
            $table->string('apellidos')->nullable(); // Nueva columna apellidos
            $table->string('username')->unique(); // Nueva columna username
            $table->string('identificacion')->nullable(); // Nueva columna identificacion
            $table->string('correoElectronico')->unique()->nullable();
            $table->string('password')->nullable();
            $table->unsignedInteger('tipoIdentificacionId')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->unsignedInteger('generoId')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedInteger('ciudadResidenciaId')->nullable();
            $table->unsignedInteger('estadoId')->default(1); // Mantener columna estadoId
            $table->timestamps();

            $table->foreign('tipoIdentificacionId')->references('id')->on('tiposidentificacion')->onDelete('set null');
            $table->foreign('generoId')->references('id')->on('generos')->onDelete('set null');
            $table->foreign('ciudadResidenciaId')->references('id')->on('ciudades')->onDelete('set null');
            // No se agrega la relación con la tabla estados porque no existe
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

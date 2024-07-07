<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Asegúrate de que este es el nombre correcto
            $table->string('apellidos');
            $table->string('tipoIdentificacion');
            $table->unsignedBigInteger('idGenero'); // Debe coincidir con la columna 'id' en 'generos'
            $table->date('fechaNacimiento');
            $table->string('correoElectronico')->unique();
            $table->string('telefonoConvencional')->nullable();
            $table->string('telefonoCelular')->nullable();
            $table->string('direccion');
            $table->unsignedBigInteger('idCiudadResidencia'); // Debe coincidir con la columna 'id' en 'ciudad_residencias'
            $table->unsignedBigInteger('idEstadoUsuario'); // Debe coincidir con la columna 'id' en 'estado_usuarios'
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('idGenero')->references('id')->on('generos')->onDelete('cascade');
            $table->foreign('idCiudadResidencia')->references('id')->on('ciudad_residencias')->onDelete('cascade');
            $table->foreign('idEstadoUsuario')->references('id')->on('estado_usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'idGenero')) {
                $table->dropForeign(['idGenero']);
            }
            if (Schema::hasColumn('users', 'idCiudadResidencia')) {
                $table->dropForeign(['idCiudadResidencia']);
            }
            if (Schema::hasColumn('users', 'idEstadoUsuario')) {
                $table->dropForeign(['idEstadoUsuario']);
            }
        });

        Schema::dropIfExists('users');
    }
}



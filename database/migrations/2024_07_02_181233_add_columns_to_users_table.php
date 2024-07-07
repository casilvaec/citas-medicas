<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'apellidos')) {
                $table->string('apellidos')->nullable();
            }
            if (!Schema::hasColumn('users', 'tipoIdentificacion')) {
                $table->string('tipoIdentificacion')->nullable();
            }
            if (!Schema::hasColumn('users', 'identificacion')) {
                $table->string('identificacion')->nullable();
            }
            if (!Schema::hasColumn('users', 'idGenero')) {
                $table->unsignedBigInteger('idGenero')->nullable();
                $table->foreign('idGenero')->references('id')->on('generos')->onDelete('cascade');
            }
            if (!Schema::hasColumn('users', 'fechaNacimiento')) {
                $table->date('fechaNacimiento')->nullable();
            }
            if (!Schema::hasColumn('users', 'telefonoConvencional')) {
                $table->string('telefonoConvencional')->nullable();
            }
            if (!Schema::hasColumn('users', 'telefonoCelular')) {
                $table->string('telefonoCelular')->nullable();
            }
            if (!Schema::hasColumn('users', 'direccion')) {
                $table->string('direccion')->nullable();
            }
            if (!Schema::hasColumn('users', 'idCiudadResidencia')) {
                $table->unsignedBigInteger('idCiudadResidencia')->nullable();
                $table->foreign('idCiudadResidencia')->references('id')->on('ciudad_residencias')->onDelete('cascade');
            }
            if (!Schema::hasColumn('users', 'idEstadoUsuario')) {
                $table->unsignedBigInteger('idEstadoUsuario')->nullable();
                $table->foreign('idEstadoUsuario')->references('id')->on('estado_usuarios')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar claves foráneas
            $table->dropForeign(['idGenero']);
            $table->dropForeign(['idCiudadResidencia']);
            $table->dropForeign(['idEstadoUsuario']);

            // Eliminar columnas de la tabla 'users'
            $table->dropColumn(['apellidos', 'tipoIdentificacion', 'identificacion', 'idGenero', 'fechaNacimiento', 'telefonoConvencional', 'telefonoCelular', 'direccion', 'idCiudadResidencia', 'idEstadoUsuario']);
        });
    }
}

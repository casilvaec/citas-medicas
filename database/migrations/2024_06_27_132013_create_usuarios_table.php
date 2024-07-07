<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Verificamos si la tabla 'usuarios' no existe antes de intentar crearla
        if (!Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->id('idUsuario');
                $table->enum('tipoIdentificacion', ['Cédula', 'Pasaporte', 'Otro']);
                $table->string('nombre', 50);
                $table->string('apellidos', 50);
                $table->unsignedBigInteger('idGenero');
                $table->date('fechaNacimiento');
                $table->string('correoElectronico', 100);
                $table->string('telefonoConvencional', 20)->nullable();
                $table->string('telefonoCelular', 20)->nullable();
                $table->string('direccion', 100);
                $table->unsignedBigInteger('idCiudadResidencia');
                $table->unsignedBigInteger('idEstadoUsuario');
                $table->string('password');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}




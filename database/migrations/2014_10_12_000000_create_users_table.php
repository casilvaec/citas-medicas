<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Cambiado de 'name' a 'nombre'
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tipoIdentificacion')->nullable();
            $table->unsignedBigInteger('idGenero')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('telefonoConvencional')->nullable();
            $table->string('telefonoCelular')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('idCiudadResidencia')->nullable();
            $table->unsignedBigInteger('idEstadoUsuario')->nullable();
            $table->boolean('estado')->default(0); // Estado inactivo por defecto
            $table->rememberToken();
            $table->timestamps();

            // Añadir las claves foráneas
            $table->foreign('idGenero')->references('id')->on('generos')->onDelete('set null');
            $table->foreign('idCiudadResidencia')->references('id')->on('ciudades')->onDelete('set null');
            $table->foreign('idEstadoUsuario')->references('id')->on('estado_usuarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

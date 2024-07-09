<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Eliminar restricciones de clave foránea
        Schema::table('nombre_de_la_tabla', function (Blueprint $table) {
            $table->dropForeign(['columna']);
        });

        // Eliminar la tabla estado_usuarios
        Schema::dropIfExists('estado_usuarios');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Crear la tabla estado_usuarios
        Schema::create('estado_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
        });

        // Volver a crear restricciones de clave foránea
        Schema::table('nombre_de_la_tabla', function (Blueprint $table) {
            $table->foreign('columna')->references('id')->on('estado_usuarios')->onDelete('cascade');
        });
    }
};

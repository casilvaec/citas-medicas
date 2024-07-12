<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEstadoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadoUsuario', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 50);
            $table->timestamps();
        });

        // Insert default values
        DB::table('estadoUsuario')->insert([
            ['estado' => 'inactivo'],
            ['estado' => 'activo'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadoUsuario');
    }
}

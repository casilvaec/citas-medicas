<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradoresTable extends Migration
{
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usuarioId');
            $table->timestamps();

            $table->foreign('usuarioId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('administradores');
    }
}


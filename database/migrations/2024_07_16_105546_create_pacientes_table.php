<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    public function up()
    {
    //     Schema::create('pacientes', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->unsignedBigInteger('usuarioId')->nullable();
    //         $table->boolean('estado')->default(1);
    //         $table->timestamps();

    //         $table->foreign('usuarioId')->references('id')->on('users')->onDelete('cascade');
    //     });
    }

    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}


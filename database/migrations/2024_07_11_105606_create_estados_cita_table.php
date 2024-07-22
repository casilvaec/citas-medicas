<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosCitaTable extends Migration
{
    public function up()
    {
    //     Schema::create('estados_cita', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->string('nombre')->unique()->nullable();
    //         $table->timestamps();
    //     });
    }

    public function down()
    {
        Schema::dropIfExists('estados_cita');
    }
}

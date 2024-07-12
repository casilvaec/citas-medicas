<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposIdentificacionTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_identificacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_identificacion');
    }
}
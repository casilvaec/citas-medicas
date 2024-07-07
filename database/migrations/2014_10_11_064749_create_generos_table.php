<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerosTable extends Migration
{
    public function up()
    {
        /*Schema::create('generos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50)->unique();
            $table->timestamps();*/
            Schema::create('generos', function (Blueprint $table) {
                $table->id();
                $table->string('descripcion');
                $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('generos');
    }
}





<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultoriosTable extends Migration
{
    public function up()
    {
        Schema::create('consultorios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('ubicacion');
            $table->string('estado')->default('Disponible');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultorios');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->unsignedInteger('menorId');
            $table->unsignedInteger('representanteId');
            $table->string('relacion')->nullable();
            $table->primary(['menorId', 'representanteId']);
            $table->timestamps();

            $table->foreign('menorId')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('representanteId')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('representantes');
    }
}


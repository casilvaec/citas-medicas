<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticosTable extends Migration
{
    public function up()
    {
    //     Schema::create('diagnosticos', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->unsignedInteger('citaId')->nullable();
    //         $table->text('descripcion')->nullable();
    //         $table->timestamps();

    //         $table->foreign('citaId')->references('id')->on('citas')->onDelete('cascade');
    //     });
    }

    public function down()
    {
        Schema::dropIfExists('diagnosticos');
    }
}


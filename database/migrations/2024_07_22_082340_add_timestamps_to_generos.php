<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToGeneros extends Migration
{
    public function up()
    {
        Schema::table('generos', function (Blueprint $table) {
            $table->timestamps(); // Agregar created_at y updated_at
        });
    }

    public function down()
    {
        Schema::table('generos', function (Blueprint $table) {
            $table->dropTimestamps(); // Eliminar created_at y updated_at
        });
    }
}

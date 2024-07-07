<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        /*Schema::create('ciudad_residencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();*/
            Schema::create('ciudad_residencias', function (Blueprint $table) {
                $table->id();
                $table->string('descripcion');
                $table->timestamps();
        
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ciudad_residencias');
    }
};

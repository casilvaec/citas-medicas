<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToHistoriasClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historiasclinicas', function (Blueprint $table) {
            $table->timestamps(); // Esto añade las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historiasclinicas', function (Blueprint $table) {
            $table->dropTimestamps(); // Esto elimina las columnas 'created_at' y 'updated_at'
        });
    }
}
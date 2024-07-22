<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToMedicosTable extends Migration
{
    public function up()
    {
        Schema::table('medicos', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('medicos', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}

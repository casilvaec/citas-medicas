<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIdColumnInConsultorios extends Migration
{
    public function up()
    {
        Schema::table('consultorios', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });
    }

    public function down()
    {
        Schema::table('consultorios', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });
    }
}

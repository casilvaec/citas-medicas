<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromRolfuncionalidades extends Migration
{
    public function up()
    {
        Schema::table('rolfuncionalidades', function (Blueprint $table) {
            $table->dropForeign(['rolId']);
        });
    }

    public function down()
    {
        Schema::table('rolfuncionalidades', function (Blueprint $table) {
            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}

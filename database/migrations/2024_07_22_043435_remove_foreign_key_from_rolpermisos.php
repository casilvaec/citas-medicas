<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromRolpermisos extends Migration
{
    public function up()
    {
        Schema::table('rolpermisos', function (Blueprint $table) {
            $table->dropForeign(['rolId']);
        });
    }

    public function down()
    {
        Schema::table('rolpermisos', function (Blueprint $table) {
            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}

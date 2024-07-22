<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdColumnInRoles extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->change();
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->integer('id')->change();
        });
    }
}

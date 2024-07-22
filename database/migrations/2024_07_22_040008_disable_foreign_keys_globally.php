<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

class DisableForeignKeysGlobally extends Migration
{
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

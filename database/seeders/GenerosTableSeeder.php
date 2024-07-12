<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('generos')->insert([
            ['nombre' => 'Masculino'],
            ['nombre' => 'Femenino'],
            ['nombre' => 'Otro'],
        ]);
    }
}

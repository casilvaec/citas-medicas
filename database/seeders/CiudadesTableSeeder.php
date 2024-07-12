<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ciudades')->insert([
            ['nombre' => 'Loja'],
            ['nombre' => 'Quito'],
            ['nombre' => 'Guayaquil'],
        ]);
    }
}


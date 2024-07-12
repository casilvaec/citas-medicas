<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposIdentificacionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_identificacion')->insert([
            ['tipo' => 'Cédula'],
            ['tipo' => 'Pasaporte'],
            ['tipo' => 'RUC'],
        ]);
    }
}

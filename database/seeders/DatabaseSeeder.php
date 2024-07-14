<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         $this->call([
//             TiposIdentificacionTableSeeder::class,cd
//             CiudadesTableSeeder::class,
//             GenerosTableSeeder::class,
//         ]);
//     }
// } -->

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
    }
}
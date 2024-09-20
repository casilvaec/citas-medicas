<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //User::all() devuelve todos los registros de la tabla 'users' como una colección de Laravel.
        return User::all();
    }
}

<?php

namespace App\Exports;

use App\Models\Consultorio;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConsultoriosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Consultorio::all();
    }
}

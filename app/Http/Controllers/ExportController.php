<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportConsultoriosCsv()
    {
        $consultorios = Consultorio::with('medico', 'medico.especialidad')->get();
        $filename = 'consultorios_' . date('Ymd') . '.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Consultorio', 'Doctor', 'Especialidad', 'Fecha de Asignación', 'Estado']);

        foreach ($consultorios as $consultorio) {
            fputcsv($handle, [
                $consultorio->nombre,
                $consultorio->medico ? $consultorio->medico->user->nombre . ' ' . $consultorio->medico->user->apellidos : '',
                $consultorio->medico && $consultorio->medico->especialidad ? $consultorio->medico->especialidad->nombre : '',
                $consultorio->medico ? $consultorio->fecha_asignacion : '',
                $consultorio->estado
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}

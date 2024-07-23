<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultorio;
use PDF;

class ConsultorioReportController extends Controller
{
    public function exportPdf()
    {
        $consultorios = Consultorio::with(['medico.user', 'medico.especialidad'])->get();
        $pdf = PDF::loadView('report.consultorios_pdf', compact('consultorios'));
        return $pdf->download('consultorios.pdf');
    }
}


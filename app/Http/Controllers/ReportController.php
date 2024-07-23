<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showConsultorios()
    {
        $consultorios = Consultorio::with('medico', 'medico.especialidad')->get();
        return view('report.consultorios', compact('consultorios'));
    }
}

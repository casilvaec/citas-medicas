<?php

// App\Http\Controllers\Admin\DisponibilidadController.php

// App\Http\Controllers\Admin\DisponibilidadController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisponibilidadMedico;
use App\Models\Medico;

class DisponibilidadController extends Controller
{
    public function index()
    {
        $medicos = Medico::all()->pluck('full_name', 'id');
        return view('admin.disponibilidad.index', compact('medicos'));
    }

    public function fetch(Request $request)
    {
        $disponibilidades = DisponibilidadMedico::where('medicoId', $request->medicoId)
            ->where('fecha', $request->fecha)
            ->get();

        return view('admin.disponibilidad.partials.table', compact('disponibilidades'))->render();
    }
}

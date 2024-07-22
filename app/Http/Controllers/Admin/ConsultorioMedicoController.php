<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultorio;
use App\Models\Medico;
use App\Models\ConsultorioMedico;

class ConsultorioMedicoController extends Controller
{
    public function index()
    {
        $consultorioMedicos = ConsultorioMedico::with(['consultorio', 'medico.user'])->get();
        return view('admin.consultorio_medico.index', compact('consultorioMedicos'));
    }

    public function create()
    {
        $consultorios = Consultorio::where('estado', 'Disponible')->pluck('nombre', 'id');
        $medicos = Medico::with('user')->get()->pluck('user.full_name', 'id');
        return view('admin.consultorio_medico.create', compact('consultorios', 'medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultorio_id' => 'required|exists:consultorios,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha_asignacion' => 'required|date',
        ]);

        ConsultorioMedico::create($request->all());

        // Actualizar estado del consultorio
        $consultorio = Consultorio::find($request->consultorio_id);
        $consultorio->update(['estado' => 'No disponible']);

        return redirect()->route('admin.consultorio_medico.index')->with('success', 'Consultorio asignado correctamente.');
    }
}

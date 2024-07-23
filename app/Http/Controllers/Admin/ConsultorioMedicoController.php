<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\AssignConsultorioRequest;
use App\Models\Consultorio;
use App\Models\Medico;
use App\Models\ConsultorioMedico;
use Illuminate\Http\Request;

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

    public function store(AssignConsultorioRequest $request)
    {
        $validatedData = $request->validated();
        
        ConsultorioMedico::create([
            'consultorio_id' => $validatedData['consultorio_id'],
            'medico_id' => $validatedData['medico_id'],
            'fecha_asignacion' => $validatedData['fecha_asignacion'],
        ]);

        // Actualizar estado del consultorio
        $consultorio = Consultorio::find($validatedData['consultorio_id']);
        $consultorio->update(['estado' => 'No disponible']);

        return redirect()->route('admin.consultorio_medico.index')->with('success', 'Consultorio asignado correctamente.');
    }
}

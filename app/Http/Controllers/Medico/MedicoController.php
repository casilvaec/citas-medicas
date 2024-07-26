<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Diagnostico;

class MedicoController extends Controller
{
    public function agenda()
    {
        // Aquí se puede filtrar por el médico logueado
        $citas = Cita::with('paciente', 'especialidad')
                    ->where('medico_id', auth()->user()->id)
                    ->get();
        return view('medico.agenda', compact('citas'));
    }

    public function atencion()
    {
        $pacientes = Paciente::all(); // Aquí se pueden filtrar los pacientes atendidos por el médico logueado
        return view('medico.atencion', compact('pacientes'));
    }

    public function historial($paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);
        $historial = Diagnostico::where('paciente_id', $paciente_id)->get();
        return view('medico.historial', compact('paciente', 'historial'));
    }

    public function registrarAtencion(Request $request)
    {
        // Aquí se registra la atención al paciente
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'diagnostico' => 'required|string',
        ]);

        Diagnostico::create([
            'paciente_id' => $request->paciente_id,
            'medico_id' => auth()->user()->id,
            'descripcion' => $request->diagnostico,
            'fecha' => now(),
        ]);

        return redirect()->route('medico.agenda')->with('success', 'Atención registrada correctamente.');
    }
}

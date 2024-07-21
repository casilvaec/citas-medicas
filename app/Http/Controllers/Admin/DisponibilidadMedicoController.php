<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DisponibilidadMedico;
use App\Models\Medico;
use Illuminate\Http\Request;

class DisponibilidadMedicoController extends Controller
{
    public function index()
    {
        $disponibilidades = DisponibilidadMedico::with('medico')->get();
        return view('admin.disponibilidad_medicos.index', compact('disponibilidades'));
    }

    public function create()
    {
        $medicos = Medico::all();
        return view('admin.disponibilidad_medicos.create', compact('medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicoId' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaInicio',
            'disponible' => 'required|boolean',
        ]);

        DisponibilidadMedico::create($request->all());

        return redirect()->route('admin.disponibilidad_medicos.index')->with('success', 'Disponibilidad médica creada correctamente.');
    }

    public function edit($id)
    {
        $disponibilidad = DisponibilidadMedico::findOrFail($id);
        $medicos = Medico::all();
        return view('admin.disponibilidad_medicos.edit', compact('disponibilidad', 'medicos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicoId' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaInicio',
            'disponible' => 'required|boolean',
        ]);

        $disponibilidad = DisponibilidadMedico::findOrFail($id);
        $disponibilidad->update($request->all());

        return redirect()->route('admin.disponibilidad_medicos.index')->with('success', 'Disponibilidad médica actualizada correctamente.');
    }

    public function destroy($id)
    {
        $disponibilidad = DisponibilidadMedico::findOrFail($id);
        $disponibilidad->delete();

        return redirect()->route('admin.disponibilidad_medicos.index')->with('success', 'Disponibilidad médica eliminada correctamente.');
    }
}

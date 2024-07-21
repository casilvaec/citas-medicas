<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HorarioMedico;
use App\Models\User; // Asegurarse de importar el modelo User
use Illuminate\Http\Request;

class HorarioMedicoController extends Controller
{
    public function index()
    {
        $horarios = HorarioMedico::with('medico')->get();
        return view('admin.horarios_medicos.index', compact('horarios'));
    }

    public function create()
    {
        $medicos = User::role('medico')->get(); // Obtener todos los médicos
        return view('admin.horarios_medicos.create', compact('medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicoId' => 'required|exists:users,id', // Cambiado para asegurar que 'users' sea la tabla referenciada
            'fecha' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaInicio',
        ]);

        HorarioMedico::create($request->all());

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico asignado correctamente.');
    }

    public function edit($id)
    {
        $horario = HorarioMedico::findOrFail($id);
        $medicos = User::role('medico')->get(); // Obtener todos los médicos
        return view('admin.horarios_medicos.edit', compact('horario', 'medicos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicoId' => 'required|exists:users,id', // Cambiado para asegurar que 'users' sea la tabla referenciada
            'fecha' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaInicio',
        ]);

        $horario = HorarioMedico::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico actualizado correctamente.');
    }

    public function destroy($id)
    {
        $horario = HorarioMedico::findOrFail($id);
        $horario->delete();

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico eliminado correctamente.');
    }

    public function searchMedicos(Request $request)
    {
        $search = $request->get('q');

        $medicos = User::role('medico')
            ->where('identificacion', 'LIKE', "%$search%")
            ->orWhere('nombre', 'LIKE', "%$search%")
            ->orWhere('apellido', 'LIKE', "%$search%")
            ->get();

        return response()->json($medicos);
    }
}

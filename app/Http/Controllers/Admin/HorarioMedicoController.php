<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HorarioMedico;
use App\Models\Medico;
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
        $medicos = Medico::all();
        return view('admin.horarios_medicos.create', compact('medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicoId' => 'required|exists:medicos,id',
            'diaSemana' => 'required|integer',
            'horaInicio' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaInicio',
        ]);

        HorarioMedico::create($request->all());

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico creado correctamente.');
    }

    public function edit(HorarioMedico $horarioMedico)
    {
        $medicos = Medico::all();
        return view('admin.horarios_medicos.edit', compact('horarioMedico', 'medicos'));
    }

    public function update(Request $request, HorarioMedico $horarioMedico)
    {
        $request->validate([
            'medicoId' => 'required|exists:medicos,id',
            'diaSemana' => 'required|integer',
            'horaInicio' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaInicio',
        ]);

        $horarioMedico->update($request->all());

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico actualizado correctamente.');
    }

    public function destroy(HorarioMedico $horarioMedico)
    {
        $horarioMedico->delete();

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico eliminado correctamente.');
    }
}

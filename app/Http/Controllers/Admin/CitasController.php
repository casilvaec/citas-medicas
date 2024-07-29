<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use App\Models\Medico;
use App\Models\EspecialidadesMedicas;
use App\Models\DisponibilidadMedico;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Cita::all();
        return view('admin.citas.index', compact('citas'));
    }

    public function create()
    {
        $pacientes = User::whereHas('roles', function($query) {
            $query->where('name', 'paciente');
        })->get();

        $especialidades = EspecialidadesMedicas::all();

        return view('admin.citas.create', compact('pacientes', 'especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:users,id',
            'medico_id' => 'required|exists:medicos,id',
            'especialidad_id' => 'required|exists:especialidades_medicas,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'motivo' => 'required|string|max:255',
        ]);

        // Marcar disponibilidad como no disponible
        $disponibilidad = DisponibilidadMedico::where('medicoId', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('horaInicio', $request->hora_inicio)
            ->first();

        if ($disponibilidad) {
            $disponibilidad->disponible = 0;
            $disponibilidad->save();
        }

        Cita::create([
            'paciente_id' => $request->paciente_id,
            'medico_id' => $request->medico_id,
            'especialidad_id' => $request->especialidad_id,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'motivo' => $request->motivo,
            'estado' => 'Programada',
        ]);

        return redirect()->route('admin.citas.index')->with('success', 'Cita agendada correctamente.');
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = User::whereHas('roles', function($query) {
            $query->where('name', 'paciente');
        })->get();
        $especialidades = EspecialidadesMedicas::all();
        $medicos = Medico::all();

        return view('admin.citas.edit', compact('cita', 'pacientes', 'especialidades', 'medicos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:users,id',
            'medico_id' => 'required|exists:medicos,id',
            'especialidad_id' => 'required|exists:especialidades_medicas,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'motivo' => 'required|string|max:255',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada correctamente.');
    }

    public function cancel($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'Cancelada';
        $cita->save();

        // Marcar disponibilidad como disponible
        $disponibilidad = DisponibilidadMedico::where('medicoId', $cita->medico_id)
            ->where('fecha', $cita->fecha)
            ->where('horaInicio', $cita->hora_inicio)
            ->first();

        if ($disponibilidad) {
            $disponibilidad->disponible = 1;
            $disponibilidad->save();
        }

        return redirect()->route('admin.citas.index')->with('success', 'Cita cancelada correctamente.');
    }

    public function reschedule($id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = User::whereHas('roles', function($query) {
            $query->where('name', 'paciente');
        })->get();
        $especialidades = EspecialidadesMedicas::all();
        $medicos = Medico::all();

        return view('admin.citas.reschedule', compact('cita', 'pacientes', 'especialidades', 'medicos'));
    }

    public function fetchMedicos(Request $request)
    {
        $especialidad_id = $request->input('especialidad_id');
        $medicos = Medico::join('medico_especialidades', 'medicos.id', '=', 'medico_especialidades.medicoId')
            ->join('users', 'medicos.usuarioId', '=', 'users.id')
            ->where('medico_especialidades.especialidadId', $especialidad_id)
            ->select('medicos.id', 'users.nombre', 'users.apellidos')
            ->get();

        $options = '<option value="">Seleccione un médico</option>';
        foreach ($medicos as $medico) {
            $options .= '<option value="' . $medico->id . '">' . $medico->nombre . ' ' . $medico->apellidos . '</option>';
        }

        return response()->json($options);
    }

}


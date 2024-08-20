<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    // public function create()
    // {
    //     $consultorios = Consultorio::where('estado', 'Disponible')->pluck('nombre', 'id');
    //     $medicos = Medico::with('user')->get()->pluck('user.full_name', 'id');
    //     return view('admin.consultorio_medico.create', compact('consultorios', 'medicos'));
    // }
    // public function create()
    // {
    //     $consultorios = Consultorio::where('estado', 'Disponible')->pluck('nombre', 'id');
    //     $medicos = Medico::with('user')->get()->filter(function ($medico) {
    //         return $medico->user !== null;
    //     })->mapWithKeys(function ($medico) {
    //         return [$medico->id => $medico->user->nombre . ' ' . $medico->user->apellidos];
    //     });

    //     return view('admin.consultorio_medico.create', compact('consultorios', 'medicos'));
    // }

    public function create()
    {
        // Obtener los consultorios disponibles, incluyendo tanto el código como el nombre
        $consultorios = Consultorio::where('estado', 'Disponible')->get()->mapWithKeys(function ($consultorio) {
            return [$consultorio->id => ['codigo' => $consultorio->codigo, 'nombre' => $consultorio->nombre]];
        });

        // Obtener los médicos con sus nombres completos
        $medicos = Medico::with('user')->get()->filter(function ($medico) {
            return $medico->user !== null;
        })->mapWithKeys(function ($medico) {
            return [$medico->id => $medico->user->nombre . ' ' . $medico->user->apellidos];
        });

        // Retornar la vista con los datos necesarios
        return view('admin.consultorio_medico.create', compact('consultorios', 'medicos'));
    }

    

    public function store(AssignConsultorioRequest $request)
    {
        $validatedData = $request->validate([
            'consultorio_id' => 'required|exists:consultorios,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha_asignacion' => 'required|date',
        ]);

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

    public function edit($id)
    {
        $consultorioMedico = ConsultorioMedico::findOrFail($id);

        // Obtener todos los médicos que tienen un usuario asociado, similar a cómo se hace en 'create'
        $medicos = Medico::with('user')->get()->filter(function ($medico) {
            return $medico->user !== null;
        })->mapWithKeys(function ($medico) {
            return [$medico->id => $medico->user->nombre . ' ' . $medico->user->apellidos];
        });

        // No permitimos la edición del consultorio y la fecha de asignación
        return view('admin.consultorio_medico.edit', compact('consultorioMedico', 'medicos'));

        // $consultorios = Consultorio::pluck('nombre', 'id');
        // $medicos = Medico::with('user')->get()->pluck('user.full_name', 'id');
        //return view('admin.consultorio_medico.edit', compact('consultorioMedico', 'consultorios', 'medicos'));
    }

    public function update(AssignConsultorioRequest $request, $id)
    {
        $validatedData = $request->validate([
            'consultorio_id' => 'required|exists:consultorios,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha_asignacion' => 'required|date',
        ]);

        $consultorioMedico = ConsultorioMedico::findOrFail($id);
        $consultorioMedico->update([
            'consultorio_id' => $validatedData['consultorio_id'],
            'medico_id' => $validatedData['medico_id'],
            'fecha_asignacion' => $validatedData['fecha_asignacion'],
        ]);

        return redirect()->route('admin.consultorio_medico.index')->with('success', 'Asignación de consultorio actualizada correctamente.');
    }

    public function destroy($id)
    {
        // Obtener la asignación de consultorio-médico
        $consultorioMedico = ConsultorioMedico::findOrFail($id);

        // Obtener el consultorio relacionado
        $consultorio = Consultorio::findOrFail($consultorioMedico->consultorio_id);

        // Eliminar la asignación de consultorio-médico
        $consultorioMedico->delete();

        // Cambiar el estado del consultorio a "Disponible"
        $consultorio->update(['estado' => 'Disponible']);

        return redirect()->route('admin.consultorio_medico.index')->with('success', 'Asignación de consultorio eliminada correctamente.');
    }
}

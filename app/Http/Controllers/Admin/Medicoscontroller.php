<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Medico;
use App\Models\EspecialidadesMedicas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class MedicosController extends Controller
{
    // Mostrar la lista de médicos
    public function index()
    {
        $medicos = Medico::with('user')->get();
        return view('admin.medicos.index', compact('medicos'));
    }

    // Mostrar el formulario para crear un nuevo médico
    public function create()
    {
        $roleMedico = Role::where('name', 'medico')->first();
        $usuarios = User::role($roleMedico)->get();
        $especialidades = EspecialidadesMedicas::where('estado', 1)->get(); //obtiene solo especialidades activas
        return view('admin.medicos.create', compact('usuarios', 'especialidades'));
    }

    // Guardar un nuevo médico
    public function store(Request $request)
    {
        $request->validate([
            'usuarioId' => 'required|exists:users,id',
            'especialidades' => 'required|array',
        ]);

        $medico = Medico::create(['usuarioId' => $request->usuarioId]);
        $medico->especialidades()->sync($request->especialidades);

        return redirect()->route('admin.medicos.index')->with('success', 'Médico creado correctamente.');
    }

    // Mostrar el formulario para editar un médico
    // public function edit($id)
    // {
    //     $medico = Medico::findOrFail($id);
    //     $roleMedico = Role::where('name', 'medico')->first();
    //     $usuarios = User::role($roleMedico)->get();                              
    //     $especialidades = EspecialidadesMedicas::where('estado', 1)->get(); //obtiene solo especialidades activas
    //     return view('admin.medicos.edit', compact('medico', 'usuarios', 'especialidades'));
    // }

    // Mostrar el formulario para editar un médico
    public function edit($id)
    {
        // Obtener el médico específico por su ID junto con sus especialidades y usuario
        $medico = Medico::with(['especialidades', 'user'])->findOrFail($id);

        // Obtener todas las especialidades disponibles
        $especialidades = EspecialidadesMedicas::where('estado', 1)->get(); // obtiene solo especialidades activas

        // No es necesario obtener todos los usuarios con el rol de 'medico', solo necesitamos el médico actual
        return view('admin.medicos.edit', compact('medico', 'especialidades'));
    }

    // Actualizar un médico
    public function update(Request $request, Medico $medico)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuarioId' => 'required|exists:users,id',
            //'especialidades' => 'required|array',
            'especialidades' => 'nullable|array',
        ]);

        // Actualizar el ID del usuario asociado al médico
        $medico->update(['usuarioId' => $request->usuarioId]);

        // Actualizar las especialidades del médico
        //$medico->especialidades()->sync($request->especialidades);
        $medico->especialidades()->sync($request->input('especialidades', []));

        return redirect()->route('admin.medicos.index')->with('success', 'Médico actualizado correctamente.');
    }

    // Eliminar la asignación de especialidad con el médico
    public function destroy($medicoId)
    {
        // Buscar el médico por su ID
        $medico = Medico::findOrFail($medicoId);

        // Eliminar todas las especialidades asociadas al médico
        $medico->especialidades()->detach();

        // Redirigir de vuelta a la lista de médicos con un mensaje de éxito
        return redirect()->route('admin.medicos.index')->with('success', 'Todas las asignaciones de especialidades han sido eliminadas correctamente.');
    }
    

    // Método de búsqueda de médicos para Select2
    public function search(Request $request)
    {
        $search = $request->input('q');
        $medicos = User::role('medico')
                    ->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('apellido', 'LIKE', "%{$search}%")
                    ->get(['id', 'nombre', 'apellido']);

        $response = [];

        foreach ($medicos as $medico) {
            $response[] = [
                'id' => $medico->id,
                'text' => $medico->nombre . ' ' . $medico->apellido
            ];
        }

        return response()->json($response);
    }
}

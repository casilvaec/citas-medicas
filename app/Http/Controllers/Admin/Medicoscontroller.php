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
    public function edit($id)
    {
        $medico = Medico::findOrFail($id);
        $roleMedico = Role::where('name', 'medico')->first();
        $usuarios = User::role( $roleMedico)->get();                              
        $especialidades = EspecialidadesMedicas::where('estado', 1)->get(); //obtiene solo especialidades activas
        return view('admin.medicos.edit', compact('medico', 'usuarios', 'especialidades'));
    }

    // Actualizar un médico
    public function update(Request $request, Medico $medico)
    {
        $request->validate([
            'usuarioId' => 'required|exists:users,id',
            'especialidades' => 'required|array',
        ]);

        $medico->update(['usuarioId' => $request->usuarioId]);
        $medico->especialidades()->sync($request->especialidades);

        return redirect()->route('admin.medicos.index')->with('success', 'Médico actualizado correctamente.');
    }

    // Eliminar un médico
    public function destroy(Medico $medico)
    {
        $medico->delete();

        return redirect()->route('admin.medicos.index')->with('success', 'Médico eliminado correctamente.');
    }
}

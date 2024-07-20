<?php

namespace App\Http\Controllers\Admin;


use App\Models\EspecialidadesMedicas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EspecialidadesMedicasController extends Controller
{
    // Mostrar la lista de especialidades
    public function index()
    {
        $especialidades = EspecialidadesMedicas::all();
        return view('admin.especialidades_medicas.index', compact('especialidades'));
    }

    // Mostrar el formulario para crear una nueva especialidad
    public function create()
    {
        return view('admin.especialidades_medicas.create');
    }

    // Guardar una nueva especialidad
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required|boolean',
        ]);

        EspecialidadesMedicas::create($request->all());

        return redirect()->route('admin.especialidades.index')->with('success', 'Especialidad médica creada exitosamente.');
    }

    // Mostrar el formulario para editar una especialidad
    public function edit($id)
    {
        $especialidad = EspecialidadesMedicas::findOrFail($id);
        return view('admin.especialidades_medicas.edit', compact('especialidad'));
    }

    // Actualizar una especialidad
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required|boolean',
        ]);

        $especialidad = EspecialidadesMedicas::findOrFail($id);
        $especialidad->update($request->all());

        return redirect()->route('admin.especialidades.index')->with('success', 'Especialidad médica actualizada exitosamente.');
    }

    // Eliminar una especialidad
    public function destroy($id)
    {
        $especialidad = EspecialidadesMedicas::findOrFail($id);
        $especialidad->delete();

        return redirect()->route('admin.especialidades.index')->with('success', 'Especialidad médica eliminada correctamente.');
    }
}

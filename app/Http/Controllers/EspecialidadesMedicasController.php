<?php

namespace App\Http\Controllers;

use App\Models\EspecialidadMedica;
use Illuminate\Http\Request;

class EspecialidadesMedicasController extends Controller
{
    // Mostrar la lista de especialidades
    public function index()
    {
        $especialidades = EspecialidadMedica::all();
        return view('especialidades_medica.index', compact('especialidades'));
    }

    // Mostrar el formulario para crear una nueva especialidad
    public function create()
    {
        return view('especialidades_medica.create');
    }

    // Guardar una nueva especialidad
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        EspecialidadMedica::create($request->all());

        return redirect()->route('especialidades.index')->with('success', 'Especialidad creada correctamente.');
    }

    // Mostrar el formulario para editar una especialidad
    public function edit(EspecialidadMedica $especialidad)
    {
        return view('especialidades_medica.edit', compact('especialidad'));
    }

    // Actualizar una especialidad
    public function update(Request $request, EspecialidadMedica $especialidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $especialidad->update($request->all());

        return redirect()->route('especialidades.index')->with('success', 'Especialidad actualizada correctamente.');
    }

    // Eliminar una especialidad
    public function destroy(EspecialidadMedica $especialidad)
    {
        $especialidad->delete();

        return redirect()->route('especialidades.index')->with('success', 'Especialidad eliminada correctamente.');
    }
}

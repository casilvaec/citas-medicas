<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Cita::all();
        return view('admin.citas.index', compact('citas'));
    }

    public function create()
    {
        // Aquí puedes obtener los datos necesarios para el formulario, como pacientes, médicos, especialidades, etc.
        return view('admin.citas.create');
    }

    public function store(Request $request)
    {
        // Validación y almacenamiento de la cita
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        // Aquí puedes obtener los datos necesarios para el formulario de edición
        return view('admin.citas.edit', compact('cita'));
    }

    public function update(Request $request, $id)
    {
        // Validación y actualización de la cita
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
        return redirect()->route('admin.citas.index')->with('success', 'Cita cancelada correctamente.');
    }

    public function reschedule($id)
    {
        $cita = Cita::findOrFail($id);
        // Aquí puedes obtener los datos necesarios para el formulario de reprogramación
        return view('admin.citas.reschedule', compact('cita'));
    }
}

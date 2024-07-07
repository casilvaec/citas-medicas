<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    // Método para listar todas las citas
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    // Método para mostrar el formulario de creación de una cita
    public function create()
    {
        return view('appointments.create');
    }

    // Método para almacenar una nueva cita
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Cita creada con éxito.');
    }

    // Método para mostrar una cita específica
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    // Método para mostrar el formulario de edición de una cita
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.edit', compact('appointment'));
    }

    // Método para actualizar una cita existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Cita actualizada con éxito.');
    }

    // Método para eliminar una cita
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Cita eliminada con éxito.');
    }
}


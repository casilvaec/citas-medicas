<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function dashboard()
    {
        return view('patient.dashboard');
    }

    public function selectSpecialty()
    {
        return view('patient.schedule');
    }

    public function selectDoctor(Request $request)
    {
        // Lógica para seleccionar doctor basada en la especialidad seleccionada
        return view('patient.select_doctor');
    }

    public function confirmAppointment(Request $request)
    {
        // Lógica para confirmar la cita médica
        return view('patient.confirm_appointment');
    }

    public function showAppointments()
    {
        return view('patient.cancel');
    }

    public function cancelAppointment(Request $request)
    {
        // Lógica para cancelar la cita
        return redirect()->route('patient.dashboard')->with('status', 'Cita cancelada correctamente');
    }

    public function editProfile()
    {
        return view('patient.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        // Lógica para actualizar el perfil
        return redirect()->route('patient.dashboard')->with('status', 'Perfil actualizado correctamente');
    }

    public function listAppointments()
{
    // Aquí puedes obtener y pasar las citas programadas al view
    return view('patient.appointments_list'); // Crear esta vista para mostrar las citas
}

}

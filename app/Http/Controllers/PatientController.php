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

    // public function showAppointments()
    // {
    //     // Obtener las citas programadas y pasarlas a la vista
    //     $appointments = [
    //         ['id' => 1, 'specialty' => 'Cardiología', 'doctor' => 'Dr. Smith', 'datetime' => '10/10/2024 10:00 AM'],
    //         ['id' => 2, 'specialty' => 'Dermatología', 'doctor' => 'Dr. Jones', 'datetime' => '11/10/2024 11:00 AM'],
    //         ['id' => 3, 'specialty' => 'Pediatría', 'doctor' => 'Dr. Brown', 'datetime' => '12/10/2024 12:00 PM']
    //     ];
    //     return view('patient.appointments_list', ['appointments' => $appointments]);
    // }

    public function showAppointments()
{
    // Aquí puedes obtener y pasar las citas programadas al view
    $appointments = [
        ['id' => 1, 'specialty' => 'Cardiología', 'doctor' => 'Dr. Smith', 'datetime' => '10/10/2024 10:00 AM'],
        ['id' => 2, 'specialty' => 'Dermatología', 'doctor' => 'Dr. Jones', 'datetime' => '11/10/2024 11:00 AM'],
        ['id' => 3, 'specialty' => 'Pediatría', 'doctor' => 'Dr. Brown', 'datetime' => '12/10/2024 12:00 PM']
    ];
    return view('patient.appointments_list', ['appointments' => $appointments]);
}

    

    // public function cancelAppointment($id)
    // {
    //     // Lógica para cancelar la cita
    //     // Aquí deberías tener lógica real para cancelar la cita en tu base de datos
    //     // Ejemplo: Appointment::find($id)->delete();
        
    //     return redirect()->route('patient.appointments_list')->with('status', 'Cita cancelada correctamente');
    // }

    public function cancelAppointment(Request $request)
{
    $appointmentId = $request->input('appointment_id');

    // Simula la eliminación de la cita. En un caso real, deberías eliminar la cita de la base de datos.

    return redirect()->route('patient.appointments.cancel')->with('status', 'Cita cancelada correctamente')->with('cancelled_id', $appointmentId);
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

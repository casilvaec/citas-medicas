<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function dashboard()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Pasar el nombre y rol del usuario a la vista
        return view('dashboard.paciente', [
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellidos,
            'rol' => 'Paciente', // Sabemos que es paciente porque ya se validó en el LoginController
        ]);
    }
}

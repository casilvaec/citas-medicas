<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    // Método para mostrar el dashboard del médico
    public function dashboard()
    {
       // Obtener el usuario autenticado
       $usuario = auth()->user();

       // Verifica si $usuario es un objeto válido antes de usarlo
       if (!$usuario) {
        return redirect()->route('home')->with('error', 'Usuario no autenticado.');
      }

        // Depurar el usuario autenticado
        //dd('Usuario autenticado:', $usuario);

       // Pasar el nombre y rol del usuario a la vista
       return view('dashboard.medico', [
           'nombre' => $usuario->nombre,
           'apellido' => $usuario->apellidos,
           'rol' => 'Médico' // Sabemos que es médico porque ya se validó
       ]);
    }

    // Puedes agregar otros métodos específicos para este controlador aquí
}

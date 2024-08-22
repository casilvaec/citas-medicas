<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PacientesController extends Controller
{
    public function create()
    {
        // ! Este método devuelve la vista para registrar un nuevo paciente
        return view('admin.pacientes.create');
    }
}

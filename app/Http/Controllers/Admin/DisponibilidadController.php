<?php

// App\Http\Controllers\Admin\DisponibilidadController.php

// App\Http\Controllers\Admin\DisponibilidadController.php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\DisponibilidadMedico;
// use App\Models\Medico;

// class DisponibilidadController extends Controller
// {
//     public function index()
//     {
//         $medicos = Medico::all()->pluck('full_name', 'id');
//         return view('admin.disponibilidad.index', compact('medicos'));
//     }

//     public function fetch(Request $request)
//     {
//         $disponibilidades = DisponibilidadMedico::where('medicoId', $request->medicoId)
//             ->where('fecha', $request->fecha)
//             ->get();

//         return view('admin.disponibilidad.partials.table', compact('disponibilidades'))->render();
//     }
// }


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DisponibilidadMedico;
use App\Models\Medico;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DisponibilidadController extends Controller
{
    public function index()
    {
        // Obtener todos los médicos con el rol de médico
        $role = Role::where('name', 'medico')->first();

        $medicos = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('medicos', 'users.id', '=', 'medicos.usuarioId')
            ->where('roles.name', 'medico')
            ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id AS medico_id"))
            ->pluck('full_name', 'medico_id');

        return view('admin.disponibilidad.index', compact('medicos'));
    }

    // public function fetch(Request $request)
    // {
    //     $medicoId = $request->input('medicoId');
    //     $fecha = $request->input('fecha');

    //     $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
    //         ->where('fecha', $fecha)
    //         ->with('medico.user')
    //         ->get();

    //     return view('admin.disponibilidad.partials.table', compact('disponibilidades'))->render();
    // }
    public function fetch(Request $request)
    {
        $medicoId = $request->input('medicoId');
        // $fecha = $request->input('fecha');

        // Obtener la disponibilidad del médico en la fecha seleccionada
        $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
            // ->whereDate('fecha', '=', $fecha)
            ->orderBy('fecha')
            ->orderBy('horaInicio')
            ->with('medico.user')
            ->get();

        return view('admin.disponibilidad.partials.table', compact('disponibilidades'))->render();
    }
}

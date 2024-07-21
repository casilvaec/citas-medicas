<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;
// use App\Models\HorarioMedico;
// use Carbon\Carbon;
// use App\Models\Medico;
// use Illuminate\Support\Facades\DB;

// class HorarioMedicoController extends Controller
// {

//   public function index()
//     {
//         $horarios = HorarioMedico::with('medico.user')->get();
//         return view('admin.horarios_medicos.index', compact('horarios'));
//     }

//     public function create()
//     {
//       $medicos = DB::table('medicos')
//       ->join('users', 'medicos.usuarioId', '=', 'users.id')
//       ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id"))
//       ->pluck('full_name', 'medicos.id');
        
//         return view('admin.horarios_medicos.create', compact('medicos'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'medicoId' => 'required',
//             'fecha' => 'required|date',
//             'horarios' => 'required|array',
//         ]);

//         $horarios = [];

//         foreach ($request->horarios as $horario) {
//             $horarios[] = [
//                 'medicoId' => $request->medicoId,
//                 'fecha' => $request->fecha,
//                 'horaInicio' => $horario == '1' ? '09:00:00' : '16:00:00',
//                 'horaFin' => $horario == '1' ? '12:00:00' : '18:00:00',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ];
//         }

//         HorarioMedico::insert($horarios);

//         return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico asignado correctamente.');
//     }
// }




namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HorarioMedico;
use Carbon\Carbon;
use App\Models\Medico;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HorarioMedicoController extends Controller
{
    public function index()
    {
        $horarios = HorarioMedico::with('medico.user')->get();
        return view('admin.horarios_medicos.index', compact('horarios'));
    }

    public function create()
    // esta es la forma correcta de filtrar todos los usuarios que tengan el rol de medico
    {
      $role = Role::where('name', 'medico')->first();

      $medicos = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
          ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
          ->leftJoin('medicos', 'users.id', '=', 'medicos.usuarioId')
          ->where('roles.name', 'medico')
          ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id AS medico_id"))
          ->pluck('full_name', 'medico_id');

      return view('admin.horarios_medicos.create', compact('medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicoId' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'horarios' => 'required|array',
        ]);

        $horarios = [];

        foreach ($request->horarios as $horario) {
            $horarios[] = [
                'medicoId' => $request->medicoId,
                'fecha' => $request->fecha,
                'horaInicio' => $horario == '1' ? '09:00:00' : '16:00:00',
                'horaFin' => $horario == '1' ? '12:00:00' : '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        HorarioMedico::insert($horarios);

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario médico asignado correctamente.');
    }
}

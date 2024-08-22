<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Cita;
// use App\Models\User;
// use App\Models\Medico;
// use App\Models\EspecialidadesMedicas;
// use App\Models\DisponibilidadMedico;
// use Illuminate\Support\Facades\DB;

// class CitasController extends Controller
// {
//     public function index()
//     {
//         $citas = Cita::all();
//         return view('admin.citas.index', compact('citas'));
//     }

//     public function create()
//     {
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();

//         $especialidades = EspecialidadesMedicas::all();

//         return view('admin.citas.create', compact('pacientes', 'especialidades'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'medico_id' => 'required|exists:medicos,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'fecha' => 'required|date',
//             'hora_inicio' => 'required|date_format:H:i',
//             'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
//             'motivo' => 'required|string|max:255',
//         ]);

//         // Marcar disponibilidad como no disponible
//         $disponibilidad = DisponibilidadMedico::where('medicoId', $request->medico_id)
//             ->where('fecha', $request->fecha)
//             ->where('horaInicio', $request->hora_inicio)
//             ->first();

//         if ($disponibilidad) {
//             $disponibilidad->disponible = 0;
//             $disponibilidad->save();
//         }

//         Cita::create([
//             'paciente_id' => $request->paciente_id,
//             'medico_id' => $request->medico_id,
//             'especialidad_id' => $request->especialidad_id,
//             'fecha' => $request->fecha,
//             'hora_inicio' => $request->hora_inicio,
//             'hora_fin' => $request->hora_fin,
//             'motivo' => $request->motivo,
//             'estado' => 'Programada',
//         ]);

//         return redirect()->route('admin.citas.index')->with('success', 'Cita agendada correctamente.');
//     }

//     public function edit($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.edit', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'medico_id' => 'required|exists:medicos,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'fecha' => 'required|date',
//             'hora_inicio' => 'required|date_format:H:i',
//             'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
//             'motivo' => 'required|string|max:255',
//         ]);

//         $cita = Cita::findOrFail($id);
//         $cita->update($request->all());

//         return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente.');
//     }

//     public function destroy($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->delete();

//         return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada correctamente.');
//     }

//     public function cancel($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->estado = 'Cancelada';
//         $cita->save();

//         // Marcar disponibilidad como disponible
//         $disponibilidad = DisponibilidadMedico::where('medicoId', $cita->medico_id)
//             ->where('fecha', $cita->fecha)
//             ->where('horaInicio', $cita->hora_inicio)
//             ->first();

//         if ($disponibilidad) {
//             $disponibilidad->disponible = 1;
//             $disponibilidad->save();
//         }

//         return redirect()->route('admin.citas.index')->with('success', 'Cita cancelada correctamente.');
//     }

//     public function reschedule($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.reschedule', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function fetchDisponibilidad(Request $request)
//     {
//         $medicoId = $request->input('medico_id');

//         $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
//             ->where('disponible', 1)
//             ->orderBy('fecha')
//             ->orderBy('horaInicio')
//             ->with('medico.user')
//             ->get();

//         return view('admin.citas.partials.disponibilidad', compact('disponibilidades'))->render();
//     }

//     public function fetchMedicos(Request $request)
//     {
//         $especialidad_id = $request->input('especialidad_id');

//         $medicos = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//             ->leftJoin('medicos', 'users.id', '=', 'medicos.usuarioId')
//             ->join('medico_especialidades', 'medicos.id', '=', 'medico_especialidades.medicoId')
//             ->where('roles.name', 'medico')
//             ->where('medico_especialidades.especialidadId', $especialidad_id)
//             ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id AS medico_id"))
//             ->pluck('full_name', 'medico_id');

//         $options = '<option value="">Seleccione un médico</option>';
//         foreach ($medicos as $id => $full_name) {
//             $options .= '<option value="' . $id . '">' . $full_name . '</option>';
//         }

//         return response()->json($options);
//     }
// } -->




// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Cita;
// use App\Models\User;
// use App\Models\Medico;
// use App\Models\EspecialidadesMedicas;
// use App\Models\DisponibilidadMedico;
// use Illuminate\Support\Facades\DB;

// class CitasController extends Controller
// {
//     public function index()
//     {
//         $citas = Cita::all();
//         return view('admin.citas.index', compact('citas'));
//     }

//     public function create()
//     {
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();

//         $especialidades = EspecialidadesMedicas::all();

//         return view('admin.citas.create', compact('pacientes', 'especialidades'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'disponibilidad_id' => 'required|exists:disponibilidad_medicos,id',
//             'motivo' => 'required|string|max:255',
//         ]);

//         $disponibilidad = DisponibilidadMedico::findOrFail($request->disponibilidad_id);

//         // Marcar disponibilidad como no disponible
//         $disponibilidad->disponible = 0;
//         $disponibilidad->save();

//         Cita::create([
//             'paciente_id' => $request->paciente_id,
//             'medico_id' => $disponibilidad->medicoId,
//             'especialidad_id' => $request->especialidad_id,
//             'fecha' => $disponibilidad->fecha,
//             'hora_inicio' => $disponibilidad->horaInicio,
//             'hora_fin' => $disponibilidad->horaFin,
//             'motivo' => $request->motivo,
//             'estado' => 'Programada',
//         ]);

//         return redirect()->route('admin.citas.index')->with('success', 'Cita agendada correctamente.');
//     }

//     public function edit($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.edit', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'medico_id' => 'required|exists:medicos,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'fecha' => 'required|date',
//             'hora_inicio' => 'required|date_format:H:i',
//             'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
//             'motivo' => 'required|string|max:255',
//         ]);

//         $cita = Cita::findOrFail($id);
//         $cita->update($request->all());

//         return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente.');
//     }

//     public function destroy($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->delete();

//         return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada correctamente.');
//     }

//     public function cancel($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->estado = 'Cancelada';
//         $cita->save();

//         // Marcar disponibilidad como disponible
//         $disponibilidad = DisponibilidadMedico::where('medicoId', $cita->medico_id)
//             ->where('fecha', $cita->fecha)
//             ->where('horaInicio', $cita->hora_inicio)
//             ->first();

//         if ($disponibilidad) {
//             $disponibilidad->disponible = 1;
//             $disponibilidad->save();
//         }

//         return redirect()->route('admin.citas.index')->with('success', 'Cita cancelada correctamente.');
//     }

//     public function reschedule($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.reschedule', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function fetchDisponibilidad(Request $request)
//     {
//         $medicoId = $request->input('medico_id');

//         $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
//             ->where('disponible', 1)
//             ->orderBy('fecha')
//             ->orderBy('horaInicio')
//             ->with('medico.user')
//             ->get();

//         return view('admin.citas.partials.disponibilidad', compact('disponibilidades'))->render();
//     }

//     public function fetchMedicos(Request $request)
//     {
//         $especialidad_id = $request->input('especialidad_id');

//         $medicos = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//             ->leftJoin('medicos', 'users.id', '=', 'medicos.usuarioId')
//             ->join('medico_especialidades', 'medicos.id', '=', 'medico_especialidades.medicoId')
//             ->where('roles.name', 'medico')
//             ->where('medico_especialidades.especialidadId', $especialidad_id)
//             ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id AS medico_id"))
//             ->pluck('full_name', 'medico_id');

//         $options = '<option value="">Seleccione un médico</option>';
//         foreach ($medicos as $id => $full_name) {
//             $options .= '<option value="' . $id . '">' . $full_name . '</option>';
//         }

//         return response()->json($options);
//     }
// }




// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Cita;
// use App\Models\User;
// use App\Models\Medico;
// use App\Models\EspecialidadesMedicas;
// use App\Models\DisponibilidadMedico;
// use Illuminate\Support\Facades\DB;

// class CitasController extends Controller
// {
//     public function index()
//     {
//         $citas = Cita::all();
//         return view('admin.citas.index', compact('citas'));
//     }

//     public function create()
//     {
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();

//         $especialidades = EspecialidadesMedicas::all();

//         return view('admin.citas.create', compact('pacientes', 'especialidades'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'disponibilidad_id' => 'required|exists:disponibilidad_medicos,id',
//         ]);

//         $disponibilidad = DisponibilidadMedico::findOrFail($request->disponibilidad_id);

//         // Marcar disponibilidad como no disponible
//         $disponibilidad->disponible = 0;
//         $disponibilidad->save();

//         Cita::create([
//             'paciente_id' => $request->paciente_id,
//             'medico_id' => $disponibilidad->medicoId,
//             'especialidad_id' => $request->especialidad_id,
//             'fecha' => $disponibilidad->fecha,
//             'hora_inicio' => $disponibilidad->horaInicio,
//             'hora_fin' => $disponibilidad->horaFin,
//             'estado' => 'Programada',
//         ]);

//         return redirect()->route('admin.citas.index')->with('success', 'Cita agendada correctamente.');
//     }

//     public function edit($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.edit', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'medico_id' => 'required|exists:medicos,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'fecha' => 'required|date',
//             'hora_inicio' => 'required|date_format:H:i',
//             'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
//         ]);

//         $cita = Cita::findOrFail($id);
//         $cita->update($request->all());

//         return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente.');
//     }

//     public function destroy($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->delete();

//         return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada correctamente.');
//     }

//     public function cancel($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->estado = 'Cancelada';
//         $cita->save();

//         // Marcar disponibilidad como disponible
//         $disponibilidad = DisponibilidadMedico::where('medicoId', $cita->medico_id)
//             ->where('fecha', $cita->fecha)
//             ->where('horaInicio', $cita->hora_inicio)
//             ->first();

//         if ($disponibilidad) {
//             $disponibilidad->disponible = 1;
//             $disponibilidad->save();
//         }

//         return redirect()->route('admin.citas.index')->with('success', 'Cita cancelada correctamente.');
//     }

//     public function reschedule($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.reschedule', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function fetchDisponibilidad(Request $request)
//     {
//         $medicoId = $request->input('medico_id');

//         $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
//             ->where('disponible', 1)
//             ->orderBy('fecha')
//             ->orderBy('horaInicio')
//             ->with('medico.user')
//             ->get();

//         return view('admin.citas.partials.disponibilidad', compact('disponibilidades'))->render();
//     }

//     public function fetchMedicos(Request $request)
//     {
//         $especialidad_id = $request->input('especialidad_id');

//         $medicos = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//             ->leftJoin('medicos', 'users.id', '=', 'medicos.usuarioId')
//             ->join('medico_especialidades', 'medicos.id', '=', 'medico_especialidades.medicoId')
//             ->where('roles.name', 'medico')
//             ->where('medico_especialidades.especialidadId', $especialidad_id)
//             ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id AS medico_id"))
//             ->pluck('full_name', 'medico_id');

//         $options = '<option value="">Seleccione un médico</option>';
//         foreach ($medicos as $id => $full_name) {
//             $options .= '<option value="' . $id . '">' . $full_name . '</option>';
//         }

//         return response()->json($options);
//     }
// }


// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Cita;
// use App\Models\User;
// use App\Models\Medico;
// use App\Models\EspecialidadesMedicas;
// use App\Models\DisponibilidadMedico;
// use Illuminate\Support\Facades\DB;

// class CitasController extends Controller
// {
//     public function index()
//     {
//         $citas = Cita::all();
//         return view('admin.citas.index', compact('citas'));
//     }

//     public function create()
//     {
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();

//         $especialidades = EspecialidadesMedicas::all();

//         return view('admin.citas.create', compact('pacientes', 'especialidades'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'disponibilidad_id' => 'required|exists:disponibilidad_medicos,id',
//         ]);

//         $disponibilidad = DisponibilidadMedico::findOrFail($request->disponibilidad_id);

//         // Marcar disponibilidad como no disponible
//         $disponibilidad->disponible = 0;
//         $disponibilidad->save();

//         Cita::create([
//             'pacienteId' => $request->paciente_id,  // Corrección de nombre de columna
//             'medicoId' => $disponibilidad->medicoId,  // Corrección de nombre de columna
//             'especialidad_id' => $request->especialidad_id,
//             'fecha' => $disponibilidad->fecha,
//             'hora_inicio' => $disponibilidad->horaInicio,
//             'hora_fin' => $disponibilidad->horaFin,
//             'estado' => 'Programada',
//         ]);

//         return redirect()->route('admin.citas.index')->with('success', 'Cita agendada correctamente.');
//     }

//     public function edit($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.edit', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'medico_id' => 'required|exists:medicos,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'fecha' => 'required|date',
//             'hora_inicio' => 'required|date_format:H:i',
//             'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
//         ]);

//         $cita = Cita::findOrFail($id);
//         $cita->update([
//             'pacienteId' => $request->paciente_id,
//             'medicoId' => $request->medico_id,
//             'especialidad_id' => $request->especialidad_id,
//             'fecha' => $request->fecha,
//             'hora_inicio' => $request->hora_inicio,
//             'hora_fin' => $request->hora_fin,
//             'estado' => $request->estado,
//         ]);

//         return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente.');
//     }

//     public function destroy($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->delete();

//         return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada correctamente.');
//     }

//     public function cancel($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->estado = 'Cancelada';
//         $cita->save();

//         // Marcar disponibilidad como disponible
//         $disponibilidad = DisponibilidadMedico::where('medicoId', $cita->medico_id)
//             ->where('fecha', $cita->fecha)
//             ->where('horaInicio', $cita->hora_inicio)
//             ->first();

//         if ($disponibilidad) {
//             $disponibilidad->disponible = 1;
//             $disponibilidad->save();
//         }

//         return redirect()->route('admin.citas.index')->with('success', 'Cita cancelada correctamente.');
//     }

//     public function reschedule($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.reschedule', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function fetchDisponibilidad(Request $request)
//     {
//         $medicoId = $request->input('medico_id');

//         $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
//             ->where('disponible', 1)
//             ->orderBy('fecha')
//             ->orderBy('horaInicio')
//             ->with('medico.user')
//             ->get();

//         return view('admin.citas.partials.disponibilidad', compact('disponibilidades'))->render();
//     }

//     public function fetchMedicos(Request $request)
//     {
//         $especialidad_id = $request->input('especialidad_id');

//         $medicos = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//             ->leftJoin('medicos', 'users.id', '=', 'medicos.usuarioId')
//             ->join('medico_especialidades', 'medicos.id', '=', 'medico_especialidades.medicoId')
//             ->where('roles.name', 'medico')
//             ->where('medico_especialidades.especialidadId', $especialidad_id)
//             ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id AS medico_id"))
//             ->pluck('full_name', 'medico_id');

//         $options = '<option value="">Seleccione un médico</option>';
//         foreach ($medicos as $id => $full_name) {
//             $options .= '<option value="' . $id . '">' . $full_name . '</option>';
//         }

//         return response()->json($options);
//     }
// }


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\User;
use App\Models\Medico;
use App\Models\EspecialidadesMedicas;
use App\Models\DisponibilidadMedico;
use Illuminate\Support\Facades\DB;


// class CitasController extends Controller
// {
    // public function index()
    // {
    //     $citas = Cita::all();
    //     return view('admin.citas.index', compact('citas'));
    // }

    // public function index() {
    //     $citas = Cita::with(['paciente.user', 'medico.user', 'especialidad'])->get();
    //     return view('admin.citas.index', compact('citas'));
    // }
    


    // public function create()
    // {
    //     $pacientes = User::whereHas('roles', function($query) {
    //         $query->where('name', 'paciente');
    //     })->get();

    //     $especialidades = EspecialidadesMedicas::all();

    //     return view('admin.citas.create', compact('pacientes', 'especialidades'));
    // }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'disponibilidad_id' => 'required|exists:disponibilidad_medicos,id',
//         ]);

//         $disponibilidad = DisponibilidadMedico::findOrFail($request->disponibilidad_id);

//         // Marcar disponibilidad como no disponible
//         $disponibilidad->disponible = 0;
//         $disponibilidad->save();

//         Cita::create([
//             'pacienteId' => $request->paciente_id,
//             'medicoId' => $disponibilidad->medicoId,
//             'especialidad_id' => $request->especialidad_id,
//             'fecha' => $disponibilidad->fecha,
//             'hora_inicio' => $disponibilidad->horaInicio,
//             'hora_fin' => $disponibilidad->horaFin,
//             'estado' => 'Programada',
//         ]);

//         return redirect()->route('admin.citas.index')->with('success', 'Cita agendada correctamente.');
//     }

//     public function edit($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.edit', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'paciente_id' => 'required|exists:users,id',
//             'medico_id' => 'required|exists:medicos,id',
//             'especialidad_id' => 'required|exists:especialidades_medicas,id',
//             'fecha' => 'required|date',
//             'hora_inicio' => 'required|date_format:H:i',
//             'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
//         ]);

//         $cita = Cita::findOrFail($id);
//         $cita->update($request->all());

//         return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente.');
//     }

//     public function destroy($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->delete();

//         return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada correctamente.');
//     }

//     public function cancel($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $cita->estado = 'Cancelada';
//         $cita->save();

//         // Marcar disponibilidad como disponible
//         $disponibilidad = DisponibilidadMedico::where('medicoId', $cita->medicoId)
//             ->where('fecha', $cita->fecha)
//             ->where('horaInicio', $cita->hora_inicio)
//             ->first();

//         if ($disponibilidad) {
//             $disponibilidad->disponible = 1;
//             $disponibilidad->save();
//         }

//         return redirect()->route('admin.citas.index')->with('success', 'Cita cancelada correctamente.');
//     }

//     public function reschedule($id)
//     {
//         $cita = Cita::findOrFail($id);
//         $pacientes = User::whereHas('roles', function($query) {
//             $query->where('name', 'paciente');
//         })->get();
//         $especialidades = EspecialidadesMedicas::all();
//         $medicos = Medico::all();

//         return view('admin.citas.reschedule', compact('cita', 'pacientes', 'especialidades', 'medicos'));
//     }

//     public function fetchDisponibilidad(Request $request)
//     {
//         $medicoId = $request->input('medico_id');

//         $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
//             ->where('disponible', 1)
//             ->orderBy('fecha')
//             ->orderBy('horaInicio')
//             ->with('medico.user')
//             ->get();

//         return view('admin.citas.partials.disponibilidad', compact('disponibilidades'))->render();
//     }

//     public function fetchMedicos(Request $request)
//     {
//         $especialidad_id = $request->input('especialidad_id');

//         $medicos = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//             ->leftJoin('medicos', 'users.id', '=', 'medicos.usuarioId')
//             ->join('medico_especialidades', 'medicos.id', '=', 'medico_especialidades.medicoId')
//             ->where('roles.name', 'medico')
//             ->where('medico_especialidades.especialidadId', $especialidad_id)
//             ->select(DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as full_name, medicos.id AS medico_id"))
//             ->pluck('full_name', 'medico_id');

//         $options = '<option value="">Seleccione un médico</option>';
//         foreach ($medicos as $id => $full_name) {
//             $options .= '<option value="' . $id . '">' . $full_name . '</option>';
//         }

//         return response()->json($options);
//     }
// }



class CitasController extends Controller
{

    public function index()
    {
        // Lógica para ver las citas
        return view('admin.citas.index');
    }

    public function agendar()
    {
        return view('admin.citas.agendar');
    }

    public function cancel()
    {
        // Lógica para cancelar citas
        return view('admin.citas.cancel');
    }

    public function reschedule()
    {
        // Lógica para reprogramar citas
        return view('admin.citas.reschedule');
    }

    // public function buscarPaciente(Request $request)
    // {
    //     $query = $request->get('query');
    //     $pacientes = Paciente::where('nombre', 'LIKE', "%$query%")
    //         ->orWhere('apellidos', 'LIKE', "%$query%")
    //         ->get();
    //     return view('admin.citas.resultados-paciente', compact('pacientes'));
    // }

    public function buscarPaciente(Request $request)
    {
        // ! Validamos la entrada para asegurarnos de que hay un valor para buscar
        $request->validate([
            'busquedaPaciente' => 'required|string|max:255',
        ]);

        // ? Realizamos la búsqueda únicamente en el campo 'numeroIdentificacion' de la tabla 'users'
        $busqueda = $request->input('busquedaPaciente');

        // * Buscamos el paciente por su número de identificación y solo pacientes con estado 2
        $usuario = User::where('numeroIdentificacion', $busqueda)
            ->where('estadoId', 2)  // Solo buscamos pacientes que hayan completado su registro (estado = 2)
           
            ->first();

        // * Verificamos si el usuario fue encontrado
        if ($usuario) {
            // * Retornamos la vista con los datos del usuario
            return view('admin.citas.agendar', compact('usuario'));
        } else {
            // * Si no se encuentra el usuario, redirigimos de vuelta con un mensaje de error
            return redirect()->route('citas.agendar')->with('error', 'No se encontró un usuario con ese número de identificación.');
        }

        // * Retornamos la vista con los resultados de la búsqueda
        //return view('admin.citas.agendar', compact('usuario'));
    }

    public function obtenerEspecialidades()
    {
        // ! Recuperar todas las especialidades médicas disponibles cone estado activo en la base de datos.
        $especialidades = EspecialidadesMedicas::where('estado', 1)->pluck('nombre', 'id');
        
        //dd($especialidades);
        //  Recuperar el ID del usuario desde el formulario anterior.
        //$usuario_id = $request->input('usuario_id');

        //  Retornar la vista `seleccionar-especialidad` con las especialidades activas y el ID del usuario.
        // return view('admin.citas.agendar', compact('especialidades', 'usuario_id'));
        // Retornar las especialidades en formato JSON para ser usadas en la vista
        return response()->json($especialidades);
        
        // // ! Retornar la vista `seleccionar-especialidad`.
        // // Solo pasamos las especialidades a la vista para que el usuario (administrador) seleccione una.
        // return view('admin.citas.seleccionar-especialidad', compact('especialidades'));
    }

    // public function mostrarMedicos(Request $request)
    // {
    //     // ! Validar que se ha recibido un ID de especialidad
    //     $request->validate([
    //         'especialidad_id' => 'required|integer',
    //     ]);

    //     // ? Buscar los médicos asociados a la especialidad seleccionada
    //     $medicos = Medico::where('especialidad_id', $request->especialidad_id)->pluck('nombre', 'id');

    //     // ? Obtener el ID del usuario (paciente) desde la solicitud
    //     $usuario_id = $request->input('usuario_id');

    //     // * Retornar la vista con la lista de médicos y el ID del usuario para continuar el proceso de agendamiento
    //     return view('admin.citas.seleccionar-medico', compact('medicos', 'usuario_id'));
    // }

    public function mostrarMedicos(Request $request)
    {
        // Validar que se ha recibido un ID de especialidad
        $request->validate([
            'especialidad_id' => 'required|integer',
        ]);

        // Obtener el ID de la especialidad
        $especialidad_id = $request->input('especialidad_id');

        // Obtener los médicos asociados a la especialidad seleccionada
        $medicos = DB::table('medico_especialidades')
            ->join('medicos', 'medico_especialidades.medicoId', '=', 'medicos.id')
            ->join('users', 'medicos.usuarioId', '=', 'users.id')
            ->where('medico_especialidades.especialidadId', $especialidad_id)
            ->select('users.id', DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as nombre_completo"))
            ->pluck('nombre_completo', 'users.id');

        // Obtener el ID del usuario (paciente) desde la solicitud
        $usuario_id = $request->input('usuario_id');
        

        $medico_id = $request->input('medico_id');

        // Retornar la vista con la lista de médicos y el ID del usuario para continuar el proceso de agendamiento
        return view('admin.citas.seleccionar-medico', compact('medicos', 'usuario_id', 'especialidad_id', 'medico_id'));
    }


    // ! Este es el método nuevo para mostrar el calendario en la misma página
    public function mostrarCalendario(Request $request)
    {
        // Obtener el ID del usuario y el médico seleccionados
        $usuario_id = $request->input('usuario_id');
        $medico_id = $request->input('medico_id');
        $especialidad_id = $request->input('especialidad_id');

        //dd($request->all());

        // Verifica el valor de especialidad_id
        //dd($especialidad_id);

        // Recuperar nuevamente los médicos, ya que la vista los requiere
        $medicos = DB::table('medico_especialidades')
            ->join('medicos', 'medico_especialidades.medicoId', '=', 'medicos.id')
            ->join('users', 'medicos.usuarioId', '=', 'users.id')
            ->where('medico_especialidades.especialidadId', $especialidad_id) // Asegúrate de que 'especialidad_id' esté disponible en el request
            ->select('users.id', DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as nombre_completo"))
            ->pluck('nombre_completo', 'users.id');

        // Simula la disponibilidad del médico para la demostración
        $disponibilidad = ['09:00', '10:00', '11:00', '12:00']; // Este es un ejemplo estático

        // Información adicional del médico y usuario
        $medico = User::find($medico_id);
        $usuario = User::find($usuario_id);

        // Verifica que ambos existan
        if (!$medico || !$usuario) {
            return redirect()->back()->with('error', 'Datos del médico o usuario no encontrados.');
        }

        // Indicamos que queremos mostrar el calendario
        $calendario = true;

        // Retornar la vista de selección de médico, pero ahora con el calendario visible
        return view('admin.citas.seleccionar-medico', compact(
            'medico_id', 'usuario_id', 'medicos', 'disponibilidad', 'calendario', 'especialidad_id'
        ))->with('medico_nombre', $medico->nombre)
        ->with('medico_apellidos', $medico->apellidos)
        ->with('usuario_nombre', $usuario->nombre)
        ->with('usuario_apellidos', $usuario->apellidos);
        // Recuperar la lista de médicos como lo hiciste en el método 'mostrarMedicos'
        // Recuperar nuevamente los médicos, ya que la vista los requiere
        // $medicos = DB::table('medico_especialidades')
        // ->join('medicos', 'medico_especialidades.medicoId', '=', 'medicos.id')
        // ->join('users', 'medicos.usuarioId', '=', 'users.id')
        // ->where('medico_especialidades.especialidadId', $request->input('especialidad_id'))
        // ->select('users.id', DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as nombre_completo"))
        // ->pluck('nombre_completo', 'users.id');

        // Información adicional del médico y usuario
        // $medico_nombre = User::find($medico_id)->nombre;
        // $medico_apellidos = User::find($medico_id)->apellidos;
        // $usuario_nombre = User::find($usuario_id)->nombre;
        // $usuario_apellidos = User::find($usuario_id)->apellidos;

        // Aquí se debería implementar la lógica para obtener las fechas y horarios disponibles
        //$disponibilidad = []; // Aquí deberías obtener la disponibilidad del médico para mostrar en el calendario
        // $calendario = true;
        // Retornar la vista de selección de médico, pero ahora con el calendario visible
        // return view('admin.citas.seleccionar-medico', compact('medico_id', 'usuario_id', 'medicos', 'disponibilidad', 'calendario', 'medico_nombre', 'medico_apellidos', 'usuario_nombre', 'usuario_apellidos'));
    }


    public function seleccionarPaciente($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('admin.citas.especialidad', compact('paciente'));
    }

    public function confirmarCita(Request $request)
    {
        // Obtenemos los datos directamente de la solicitud, que ya han sido pasados desde la vista anterior.
        $usuario_nombre = $request->input('usuario_nombre');
        $usuario_apellidos = $request->input('usuario_apellidos');
        $medico_nombre = $request->input('medico_nombre');
        $medico_apellidos = $request->input('medico_apellidos');
        $especialidad = $request->input('especialidad');
        $fecha_cita = $request->input('fecha_cita');
        $horario_cita = $request->input('horario_cita');
        // $usuario_id = $request->input('usuario_id');
        // $medico_id = $request->input('medico_id');
        // $fecha_cita = $request->input('fecha_cita');
        // $horario_cita = $request->input('horario_cita');

        // Obtener los nombres del paciente y del médico
        // $usuario = User::find($usuario_id);
        // $medico = Medico::find($medico_id);
        // $especialidad = DB::table('medico_especialidades')
        //                 ->join('especialidades_medicas', 'medico_especialidades.especialidadId', '=', 'especialidades_medicas.id')
        //                 ->where('medico_especialidades.medicoId', $medico_id)
        //                 ->select('especialidades_medicas.nombre')
        //                 ->first();

        // Aquí guardas la cita en la base de datos
        // Ejemplo:
        // Cita::create([
        //     'usuario_id' => $usuario_id,
        //     'medico_id' => $medico_id,
        //     'fecha_cita' => $fecha_cita,
        //     'horario_cita' => $horario_cita,
        // ]);

        // Retornar la vista de confirmación con los datos ya obtenidos
        return view('admin.citas.confirmacion', compact('usuario_nombre', 'usuario_apellidos', 'medico_nombre', 'medico_apellidos', 'especialidad', 'fecha_cita', 'horario_cita'));
        //return view('admin.citas.confirmacion', compact('usuario_id', 'medico_id', 'fecha_cita', 'horario_cita'));
    }

    public function especialidad()
    {
        // Lógica para seleccionar especialidad
    }

    public function confirmacion(Request $request)
    {
        // Lógica para guardar la cita
        // return view('admin.citas.confirmacion');
    }

    
}

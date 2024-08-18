<?php





namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HorarioMedico;
use App\Models\DisponibilidadMedico;
use Carbon\Carbon;
use App\Models\Medico;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;


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
        

        if (empty($request->medicoId)) {
            return redirect()->back()->with('error', 'Debe seleccionar un médico.');
        }

        

        $request->validate([
            'medicoId' => 'required|exists:medicos,id',
            'horarios' => 'nullable|array',
        ]);

        

        // * Se obtiene el objeto médico usando el ID.
        $medico = Medico::findOrFail($request->medicoId);

        //$horariosAsignados = 0;
        $horarioNuevoAsignado = 0;
        $horarioYaAsignado = 0;

        // Verificar si se seleccionó al menos un horario
        
        if (empty($request->horarios)) {
            
            return redirect()->back()
                ->with('error', 'Debe seleccionar al menos un horario a ser asignado.');
        }

        foreach ($request->horarios as $horario) {
            if ($horario == '1') {
                $horaInicio = '09:00:00';
                $horaFin = '12:00:00';

                
    
                $horarioExistente = HorarioMedico::where('medicoId', $medico->id)
                    ->where('horaInicio', $horaInicio)
                    ->exists();

                
    
                if (!$horarioExistente) {
                    HorarioMedico::create([
                        'medicoId' => $medico->id,
                        'fecha' => now()->format('Y-m-d'),
                        'horaInicio' => $horaInicio,
                        'horaFin' => $horaFin,
                    ]);
                    $horarioNuevoAsignado++;
                } else {
                    $horarioYaAsignado++;
                }
            }
           

            if ($horario == '2') {
                $horaInicio = '16:00:00';
                $horaFin = '18:00:00';

                
    
                $horarioExistente = HorarioMedico::where('medicoId', $medico->id)
                    ->where('horaInicio', $horaInicio)
                    ->exists();

                
    
                if (!$horarioExistente) {
                    HorarioMedico::create([
                        'medicoId' => $medico->id,
                        'fecha' => now()->format('Y-m-d'),
                        'horaInicio' => $horaInicio,
                        'horaFin' => $horaFin,
                    ]);
                    $horarioNuevoAsignado++;
                } else {
                    $horarioYaAsignado++;
                }
            }

            
        }

        

        if ($horarioNuevoAsignado == 1 && $horarioYaAsignado == 1) {
            // Caso 1: Uno de los horarios ya estaba asignado, pero se asignó un nuevo horario
            return redirect()->route('admin.horarios_medicos.index')
                ->with('info', 'Se asignó un nuevo horario, pero uno de los horarios ya estaba asignado.');
        } elseif ($horarioNuevoAsignado == 0 && $horarioYaAsignado == 0) {
            // Caso 2: Ningún horario fue seleccionado (aunque este debería ser capturado por la validación de formulario)
            return redirect()->route('admin.horarios_medicos.index')
                ->with('error', 'No se seleccionó ningún horario. Intente nuevamente.');
        }elseif ($horarioNuevoAsignado == 1 && $horarioYaAsignado == 0) {
            // Caso 5: Se asignó un único nuevo horario
            return redirect()->route('admin.horarios_medicos.index')
                ->with('success', 'Horario médico fue asignado correctamente.');
        
        } elseif ($horarioYaAsignado == 2) {
            // Caso 3: El médico ya tenía asignados ambos horarios
            return redirect()->route('admin.horarios_medicos.index')
                ->with('warning', 'El médico ya tenía asignado estos horario(s).');
        } elseif ($horarioNuevoAsignado == 2) {
            // Caso 4: Se asignaron ambos horarios nuevos
            return redirect()->route('admin.horarios_medicos.index')
                ->with('success', 'Horario médico asignado correctamente.');
        } elseif ($horarioYaAsignado == 1) {
            // Caso 5: El médico ya tenía uno de los horarios asignados, pero no se seleccionó ningún horario nuevo
            return redirect()->route('admin.horarios_medicos.index')
                ->with('info', 'El médico ya tenía asignado el horario seleccionado. No se realizaron cambios.');
        } else {
            // Caso 6: Red de seguridad para cualquier error inesperado
            return redirect()->route('admin.horarios_medicos.index')
                ->with('error', 'Hubo un problema al asignar los horarios.');
        }
        
        

        

    }

        

    public function edit($id)
    {
        // Buscar el horario médico por id
        $horarioMedico = HorarioMedico::findOrFail($id);

        // Retornar la vista de edición con los datos del horario médico
        return view('admin.horarios_medicos.edit', compact('horarioMedico'));
    }




    public function update(Request $request, $id)
    {
        $horarioMedico = HorarioMedico::findOrFail($id);

        // Si el checkbox fue desmarcado, se elimina el horario
        if (!$request->has('horario')) {
            $horarioMedico->delete();
            return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario asignado eliminado correctamente.');
        }

        // Actualizar el horario basado en el valor del checkbox
        if ($request->input('horario') == '1') {
            $horarioMedico->update([
                'horaInicio' => '09:00:00',
                'horaFin' => '12:00:00',
            ]);
        } elseif ($request->input('horario') == '2') {
            $horarioMedico->update([
                'horaInicio' => '16:00:00',
                'horaFin' => '18:00:00',
            ]);
        }

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Horario actualizado correctamente.');
    }


    // Agregar el método destroy
    public function destroy($id)
    {
        // Buscar el horario médico por id y eliminarlo
        $horarioMedico = HorarioMedico::findOrFail($id);
        $horarioMedico->delete();

        return redirect()->route('admin.horarios_medicos.index')->with('success', 'Asignación de horario médico eliminado correctamente.');
    }



}

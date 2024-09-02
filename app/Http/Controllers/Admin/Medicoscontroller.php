<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Medico;
use App\Models\EspecialidadesMedicas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\Cita;
use App\Models\HistoriaClinica;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;  // Importar DB para consultas SQL


class MedicosController extends Controller
{
    // Mostrar la lista de médicos
    public function index()
    {
        $medicos = Medico::with('user')->get();
        return view('admin.medicos.index', compact('medicos'));
    }

    // Mostrar el formulario para crear un nuevo médico
    public function create()
    {
        $roleMedico = Role::where('name', 'medico')->first();
        $usuarios = User::role($roleMedico)->get();
        $especialidades = EspecialidadesMedicas::where('estado', 1)->get(); //obtiene solo especialidades activas
        return view('admin.medicos.create', compact('usuarios', 'especialidades'));
    }

    // Guardar un nuevo médico
    public function store(Request $request)
    {
        
        // Verificar si se seleccionó un médico
        if (empty($request->usuarioId)) {
            return redirect()->back()->with('error', 'Debe seleccionar un médico.');
        }

        $request->validate([
            'usuarioId' => 'required|exists:users,id',
            'especialidades' => 'nullable|array',
        ]);

        // Verificar si se seleccionó al menos una especialidad
        if (empty($request->especialidades)) {
            return redirect()->back()->with('error', 'Debe seleccionar al menos una especialidad.');
        }

        
        // Verificar si ya hay un registro de asignación del médico, si no, crearlo
        $medico = Medico::firstOrCreate(['usuarioId' => $request->usuarioId]);

        $especialidadesNuevas = [];
        $especialidadesExistentes = 0;

        if (!empty($request->especialidades)) {
            foreach ($request->especialidades as $especialidad) {
                if (!$medico->especialidades()->where('especialidadId', $especialidad)->exists()) {
                    $especialidadesNuevas[] = $especialidad;
                } else {
                    $especialidadesExistentes++;
                }
            }
        }
    
        // Asignar las nuevas especialidades
        if (!empty($especialidadesNuevas)) {
            $medico->especialidades()->attach($especialidadesNuevas);
        }

        // Determinar el mensaje a mostrar
        if ($especialidadesExistentes > 0 && empty($especialidadesNuevas)) {
            return redirect()->route('admin.medicos.index')->with('warning', 'El médico ya tenía asignadas las especialidades seleccionadas. No se realizaron cambios.');
        } elseif (!empty($especialidadesNuevas)) {
            return redirect()->route('admin.medicos.index')->with('success', 'Especialidades asignadas correctamente.');
        } else {
            return redirect()->route('admin.medicos.index')->with('info', 'No se seleccionaron nuevas especialidades para asignar.');
        }

        
    }

    

    // Mostrar el formulario para editar la asignación de un médico
    public function edit($id)
    {
        // Obtener el médico específico por su ID junto con sus especialidades y usuario
        $medico = Medico::with(['especialidades', 'user'])->findOrFail($id);

        // Obtener todas las especialidades disponibles
        $especialidades = EspecialidadesMedicas::where('estado', 1)->get(); // obtiene solo especialidades activas

        // No es necesario obtener todos los usuarios con el rol de 'medico', solo necesitamos el médico actual
        return view('admin.medicos.edit', compact('medico', 'especialidades'));
    }

    // Actualizar un médico
    public function update(Request $request, Medico $medico)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuarioId' => 'required|exists:users,id',
            //'especialidades' => 'required|array',
            'especialidades' => 'nullable|array',
        ]);

        // Actualizar el ID del usuario asociado al médico
        $medico->update(['usuarioId' => $request->usuarioId]);

        // Actualizar las especialidades del médico
        //$medico->especialidades()->sync($request->especialidades);
        $medico->especialidades()->sync($request->input('especialidades', []));

        return redirect()->route('admin.medicos.index')->with('success', 'Médico actualizado correctamente.');
    }

    // Eliminar la asignación de especialidad con el médico
    public function destroy($medicoId)
    {
        // Buscar el médico por su ID
        $medico = Medico::findOrFail($medicoId);

        // Eliminar todas las especialidades asociadas al médico
        $medico->especialidades()->detach();

        // Redirigir de vuelta a la lista de médicos con un mensaje de éxito
        return redirect()->route('admin.medicos.index')->with('success', 'Todas las asignaciones de especialidades han sido eliminadas correctamente.');
    }
    

    // Método de búsqueda de médicos para Select2
    public function search(Request $request)
    {
        $search = $request->input('q');
        $medicos = User::role('medico')
                    ->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('apellido', 'LIKE', "%{$search}%")
                    ->get(['id', 'nombre', 'apellido']);

        $response = [];

        foreach ($medicos as $medico) {
            $response[] = [
                'id' => $medico->id,
                'text' => $medico->nombre . ' ' . $medico->apellido
            ];
        }

        return response()->json($response);
    }

    public function agenda($medico_id)
    {
        // Simular el ID del médico para pruebas (usa un ID fijo)
        //$medicoId = 24; // Cambia '1' por el ID del médico que estás probando
    
        Log::info('Entrando al método agenda con medico_id: ' . $medico_id);

        // Consulta SQL directa para obtener las citas con el paciente y la especialidad asociada
        $citas = DB::select("
            SELECT 
                c.id AS cita_id, 
                c.medicoId AS medico_id, 
                c.pacienteId AS paciente_id, 
                u.nombre AS paciente_nombre, 
                u.apellidos AS paciente_apellidos, 
                u.fechaNacimiento AS fecha_nacimiento, -- Agregar la fecha de nacimiento del paciente
                c.fecha AS fecha_cita, 
                c.hora_inicio AS hora_inicio, 
                c.hora_fin AS hora_fin, 
                c.especialidad_id AS especialidad_id, 
                e.nombre AS especialidad_nombre 
            FROM citas c
            LEFT JOIN users u ON c.pacienteId = u.id -- Relación con el usuario (paciente)
            LEFT JOIN especialidades_medicas e ON c.especialidad_id = e.id -- Relación con la especialidad médica
            WHERE c.medicoId = ?
            ORDER BY c.fecha ASC, c.hora_inicio ASC
        ", [$medico_id]);

        // Obtener el médico basado en el ID proporcionado
        //$medico = Medico::findOrFail($medico_id);
    
        // Obtener todas las citas del médico
        // $citas = Cita::with(['paciente', 'especialidad'])
        //             ->where('medicoId', $medico->id)
        //             ->orderBy('fecha', 'asc')
        //             ->orderBy('hora_inicio', 'asc')
        //             ->get();
    
        // Registrar en el log el número de citas encontradas
        Log::info("Número de citas encontradas: " . count($citas));
        
        // Retornar la vista con las citas del médico
        return view('medico.agenda', compact('citas'));
    }

    public function atenderCita($cita_id)
    {
        // Obtener la cita con el paciente y la especialidad asociados
        $cita = Cita::with(['paciente', 'especialidad'])->findOrFail($cita_id);

        // Asumir que estamos utilizando un ID de médico fijo
        $medicoIdFijo = 24; // Aquí pones el ID del médico que quieras usar para pruebas

        // Verificar que la cita pertenezca al médico con el ID fijo
        if ($cita->medicoId !== $medicoIdFijo) {
            return redirect()->back()->with('error', 'No tienes permiso para atender esta cita.');
        }

        // Retornar la vista para atender la cita
        return view('medico.atender', compact('cita'));
    }

    // Método para registrar la atención del paciente
    public function registrarAtencion(Request $request, $cita_id)
    {
        // Obtener la cita por su ID
        $cita = Cita::findOrFail($cita_id);

        // Crear nueva historia clínica y asociarla con la cita y el paciente
        $historia = new HistoriaClinica();
        $historia->pacienteId = $cita->pacienteId; // Usamos el ID del paciente desde la cita
        $historia->citaId = $cita->id; // Asociamos la historia con la cita
        $historia->fechaHora = now();  // Registramos la fecha y hora actual (puedes usar la fecha de la cita también)
        $historia->diagnostico = $request->input('diagnostico'); // Diagnóstico proporcionado por el médico
        $historia->examenes = $request->input('examenes'); // Exámenes solicitados
        $historia->receta = $request->input('receta'); // Receta médica generada
        $historia->proximoControl = $request->input('proximo_control'); // Fecha del próximo control
        $historia->save(); // Guardamos la historia clínica

        // Marcar la cita como atendida en la tabla citas
        $cita->estado = 'Atendida'; // Actualizamos el estado a 'Atendida'
        $cita->save(); // Guardamos los cambios en la cita

        // Redirigir a la agenda del médico con un mensaje de éxito
        return redirect()->route('medico.agenda')->with('success', 'Atención registrada con éxito.');
    }
}

    



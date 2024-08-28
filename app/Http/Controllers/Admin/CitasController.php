<?php

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
use Illuminate\Support\Facades\Log;


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
        
        
        return response()->json($especialidades);
        
    }


    public function mostrarMedicos(Request $request)
    {
        // Validar que se ha recibido un ID de especialidad
        Log::info('Validando ID de especialidad recibido en la solicitud');
        $request->validate([
            'especialidad_id' => 'required|integer',
        ]);

        // Obtener el ID de la especialidad
        Log::info('Obteniendo ID de especialidad de la solicitud');
        $especialidad_id = $request->input('especialidad_id');

        // Obtener los médicos asociados a la especialidad seleccionada
        Log::info('Consultando médicos asociados a la especialidad ID: ' . $especialidad_id);
        $medicos = DB::table('medico_especialidades')
            ->join('medicos', 'medico_especialidades.medicoId', '=', 'medicos.id')
            ->join('users', 'medicos.usuarioId', '=', 'users.id')
            ->where('medico_especialidades.especialidadId', $especialidad_id)
            ->select('users.id', DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as nombre_completo"))
            ->pluck('nombre_completo', 'users.id');

        // Obtener el ID del usuario (paciente) desde la solicitud
        Log::info('Obteniendo ID del usuario (paciente) de la solicitud');
        $usuario_id = $request->input('usuario_id');
        
        // Obtener el ID del médico desde la solicitud
        Log::info('Obteniendo ID del médico de la solicitud');
        $medico_id = $request->input('medico_id');

        // Almacenar el ID del médico en la sesión
        // Agregué esta línea para almacenar el ID del médico en la sesión
        Log::info('Almacenando ID del médico en la sesión');
        session()->put('medico_id', $medico_id); // <--- Agregué esta línea


        // Retornar la vista con la lista de médicos y el ID del usuario para continuar el proceso de agendamiento
        Log::info('Retornando vista con lista de médicos y ID del usuario');
        return view('admin.citas.seleccionar-medico', compact('medicos', 'usuario_id', 'especialidad_id', 'medico_id'));
    }


    // ! Este es el método nuevo para mostrar el calendario en la misma página
    public function mostrarCalendario(Request $request)
    {
        // Obtener el ID del usuario y el médico seleccionados
        Log::info('Obteniendo ID del usuario y médico seleccionados');
        Log::info('Request: ' . json_encode($request->all()));

        $usuario_id = $request->input('usuario_id');
        Log::info('Usuario ID: ' . $usuario_id);

        $medico_id_usuario = $request->input('medico_id'); // ID del médico desde el request
        Log::info('Médico ID desde request: ' . $medico_id_usuario);

        //$medico_id = $request->input('medico_id');
        $especialidad_id = $request->input('especialidad_id');
        Log::info('Especialidad ID: ' . $especialidad_id);

         // Obtener el ID del médico desde la tabla medicos
        Log::info('Obteniendo ID del médico desde la tabla medicos');
        $medico = Medico::where('usuarioId', $medico_id_usuario)->first();
        Log::info('Médico encontrado: ' . json_encode($medico));
        $medico_id = $medico->id; // ID del médico en la tabla medicos
        Log::info('Médico ID: ' . $medico_id);

         // Obtener el ID del médico desde la sesión
        //  Log::info('Obteniendo ID del médico desde la sesión');
        // $medico_id = session()->get('medico_id');
        // Log::info('Médico ID desde sesión: ' . $medico_id);

        //dd($request->all());

        // Verifica el valor de especialidad_id
        Log::info('Verificando valor de especialidad_id');
        Log::info('Especialidad ID: ' . $especialidad_id);
        //dd($especialidad_id);

        // Recuperar nuevamente los médicos, ya que la vista los requiere
        Log::info('Recuperando médicos para la vista');
        $medicos = DB::table('medico_especialidades')
            ->join('medicos', 'medico_especialidades.medicoId', '=', 'medicos.id')
            ->join('users', 'medicos.usuarioId', '=', 'users.id')
            ->where('medico_especialidades.especialidadId', $especialidad_id) // Asegúrate de que 'especialidad_id' esté disponible en el request
            ->select('users.id', DB::raw("CONCAT(users.nombre, ' ', users.apellidos) as nombre_completo"))
            ->pluck('nombre_completo', 'users.id');


        // Consultar disponibilidad del médico
        Log::info('Consultando disponibilidad del médico');
        $disponibilidad = DB::table('disponibilidad_medicos')
            ->where('medicoId', $medico_id)
            ->get();
        Log::info('Disponibilidad del médico: ' . json_encode($disponibilidad));

        // Simula la disponibilidad del médico para la demostración
        // Log::info('Simulando disponibilidad del médico');
        // $disponibilidad = ['09:00', '10:00', '11:00', '12:00']; // Este es un ejemplo estático
        // Log::info('Disponibilidad simulada: ' . json_encode($disponibilidad));

        // Información adicional del médico y usuario
        Log::info('Obteniendo información adicional del médico y usuario');
        $medico = User::find($medico_id);
        Log::info('Médico encontrado: ' . json_encode($medico));
        $usuario = User::find($usuario_id);
        Log::info('Usuario encontrado: ' . json_encode($usuario));

        // Verifica que ambos existan
        Log::info('Verificando que médico y usuario existan');
        if (!$medico || !$usuario) {
            Log::warning('Datos del médico o usuario no encontrados');
            Log::warning('Médico ID: ' . $medico_id);
            Log::warning('Usuario ID: ' . $usuario_id);
            return redirect()->back()->with('error', 'Datos del médico o usuario no encontrados.');
        }

        // Indicamos que queremos mostrar el calendario
        Log::info('Mostrando calendario');
        $calendario = true;

        // Retornar la vista de selección de médico, pero ahora con el calendario visible
        Log::info('Retornando vista con calendario');
        return view('admin.citas.seleccionar-medico', compact(
            'medico_id', 'usuario_id', 'medicos', 'disponibilidad', 'calendario', 'especialidad_id'
        ))->with('medico_nombre', $medico->nombre)
        ->with('medico_apellidos', $medico->apellidos)
        ->with('usuario_nombre', $usuario->nombre)
        ->with('usuario_apellidos', $usuario->apellidos);
        
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

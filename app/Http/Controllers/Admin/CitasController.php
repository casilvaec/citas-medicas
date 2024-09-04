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

        // Consulta para obtener todas las citas médicas ordenadas por fecha y hora ascendente
            $citas = DB::table('citas')
            ->join('users as pacientes', 'citas.pacienteId', '=', 'pacientes.id')
            ->join('especialidades_medicas as especialidades', 'citas.especialidad_id', '=', 'especialidades.id')
            ->join('medicos', 'citas.medicoId', '=', 'medicos.id')
            ->join('users as medicos_usuarios', 'medicos.usuarioId', '=', 'medicos_usuarios.id')
            ->select(
                'citas.id as cita_id',
                'pacientes.nombre as paciente_nombre',
                'pacientes.apellidos as paciente_apellido',
                'medicos_usuarios.nombre as medico_nombre',
                'medicos_usuarios.apellidos as medico_apellido',
                'citas.fecha',
                'citas.hora_inicio',
                'citas.hora_fin',
                'especialidades.nombre as especialidad_nombre',
                'citas.estado'
            )
            ->orderBy('citas.fecha', 'asc')
            ->orderBy('citas.hora_inicio', 'asc')
            ->get();

        return view('admin.citas.index', compact('citas'));

        //$citas = Cita::all(); // O una consulta más específica si es necesario
        // Lógica para ver las citas
        //return view('admin.citas.index');
    }

    public function agendar()
    {
        return view('admin.citas.agendar');
    }

    public function cancel()
    {
        // Consulta SQL para obtener las citas con estado 'Agendada' o 'Reagendada'
        $citas = DB::table('citas')
            ->join('users as pacientes', 'citas.pacienteId', '=', 'pacientes.id')
            ->join('especialidades_medicas as especialidades', 'citas.especialidad_id', '=', 'especialidades.id')
            ->join('medicos', 'citas.medicoId', '=', 'medicos.id')
            ->join('users as doctores', 'medicos.usuarioId', '=', 'doctores.id')
            ->select(
                'citas.id as cita_id',
                'pacientes.nombre as paciente_nombre',
                'pacientes.apellidos as paciente_apellido',
                'doctores.nombre as medico_nombre',
                'doctores.apellidos as medico_apellido',
                'citas.fecha',
                'citas.hora_inicio',
                'citas.hora_fin',
                'especialidades.nombre as especialidad_nombre',
                'citas.estado'
            )
            ->whereIn('citas.estado', ['Agendada', 'Reagendada']) // Solo mostrar citas que puedan cancelarse
            ->orderBy('citas.fecha', 'asc')
            ->orderBy('citas.hora_inicio', 'asc')
            ->get();

        return view('admin.citas.cancel', compact('citas'));
        // Lógica para cancelar citas
        //return view('admin.citas.cancel');
    }


    public function cancelarCita($id)
    {
        $cita = DB::table('citas')->where('id', $id)->first();

        if ($cita && $cita->estado != 'Cancelada') {
            // Iniciar una transacción para asegurar que ambas operaciones se realicen o ninguna
            DB::beginTransaction();
            try {
                // Cambiar el estado de la cita a 'Cancelada'
                DB::table('citas')
                    ->where('id', $id)
                    ->update(['estado' => 'Cancelada']);

                // Liberar el horario del médico en la tabla 'disponibilidad_medicos'
                $horarioLiberado = DB::table('disponibilidad_medicos')
                    ->where('medicoId', $cita->medicoId)  // Cambiar a 'medicoId'
                    ->where('fecha', $cita->fecha)
                    ->where('horaInicio', $cita->hora_inicio)  // Cambiar a 'horaInicio'
                    ->update(['disponible' => 1]);  // Cambiar el estado de disponibilidad a 1 para "Disponible"

                // Verificar si se realizó la actualización del estado de disponibilidad
                if ($horarioLiberado) {
                    DB::commit();  // Confirmar la transacción
                    return redirect()->route('admin.citas.cancel')->with('success', 'Cita cancelada exitosamente y horario liberado.');
                } else {
                    // Si no se pudo liberar el horario, revertir el cambio de estado de la cita
                    DB::rollBack();
                    return redirect()->route('admin.citas.cancel')->with('error', 'No se pudo liberar el horario, por lo tanto, no se canceló la cita.');
                }
            } catch (\Exception $e) {
                DB::rollBack();  // Revertir cambios si ocurre un error
                return redirect()->route('admin.citas.cancel')->with('error', 'Error al cancelar la cita. Por favor, inténtelo de nuevo.');
            }
        } else {
            return redirect()->route('admin.citas.cancel')->with('error', 'No se puede cancelar esta cita.');
        }
    }


    public function reschedule()
    {
        $citas = DB::table('citas')
            ->join('users as pacientes', 'citas.pacienteId', '=', 'pacientes.id')
            ->join('medicos', 'citas.medicoId', '=', 'medicos.id')
            ->join('users as medicosUsuarios', 'medicos.usuarioId', '=', 'medicosUsuarios.id')
            ->join('especialidades_medicas as especialidades', 'citas.especialidad_id', '=', 'especialidades.id')
            ->select(
                'citas.id as cita_id',
                'pacientes.nombre as paciente_nombre',
                'pacientes.apellidos as paciente_apellido',
                'medicosUsuarios.nombre as medico_nombre',
                'medicosUsuarios.apellidos as medico_apellido',
                'especialidades.nombre as especialidad_nombre',
                'citas.fecha',
                'citas.hora_inicio',
                'citas.hora_fin'
            )
            ->where('citas.estado', 'Agendada')
            ->get();
    
        return view('admin.citas.reschedule', compact('citas'));
    }
    

    public function update(Request $request, $id)
    {
        $cita = DB::table('citas')->where('id', $id)->first();

        if ($cita) {
            // Validar que el nuevo horario esté disponible
            $disponible = DB::table('disponibilidad_medicos')
                ->where('medicoId', $cita->medicoId)
                ->where('fecha', $request->input('fecha'))
                ->where('horaInicio', explode(' - ', $request->input('horario'))[0])
                ->where('disponible', 1)
                ->first();

            if ($disponible) {
                // Actualizar la disponibilidad del horario anterior a "Disponible"
                DB::table('disponibilidad_medicos')
                    ->where('medicoId', $cita->medicoId)
                    ->where('fecha', $cita->fecha)
                    ->where('horaInicio', $cita->hora_inicio)
                    ->update(['disponible' => 1]);

                // Actualizar la disponibilidad del nuevo horario a "No Disponible"
                DB::table('disponibilidad_medicos')
                    ->where('medicoId', $cita->medicoId)
                    ->where('fecha', $request->input('fecha'))
                    ->where('horaInicio', explode(' - ', $request->input('horario'))[0])
                    ->update(['disponible' => 2]);

                // Actualizar la cita con la nueva fecha, horario y estado
                DB::table('citas')
                    ->where('id', $id)
                    ->update([
                        'fecha' => $request->input('fecha'),
                        'hora_inicio' => explode(' - ', $request->input('horario'))[0],
                        'hora_fin' => explode(' - ', $request->input('horario'))[1],
                        'estado' => 'Reagendada' // Cambiar el estado de la cita a "Reagendada"
                    ]);

                // Redirigir a la vista de confirmación de la reprogramación de la cita
                return redirect()->route('admin.admin.citas.confirmacionReprogramacion', ['id' => $id]);
            } else {
                return back()->with('error', 'El horario seleccionado no está disponible.');
            }
        }

        return back()->with('error', 'Cita no encontrada.');
    }



    public function confirmacionReprogramacion($id)
    {
        $cita = DB::table('citas')
            ->join('users as pacientes', 'citas.pacienteId', '=', 'pacientes.id')
            ->join('medicos', 'citas.medicoId', '=', 'medicos.id')
            ->join('users as medicosUsuarios', 'medicos.usuarioId', '=', 'medicosUsuarios.id')
            ->join('especialidades_medicas as especialidades', 'citas.especialidad_id', '=', 'especialidades.id')
            ->select(
                'citas.id as cita_id',
                'pacientes.nombre as paciente_nombre',
                'pacientes.apellidos as paciente_apellido',
                'medicosUsuarios.nombre as medico_nombre',
                'medicosUsuarios.apellidos as medico_apellido',
                'especialidades.nombre as especialidad_nombre',
                'citas.fecha',
                'citas.hora_inicio',
                'citas.hora_fin',
                'citas.estado'
            )
            ->where('citas.id', $id)
            ->first();

        return view('admin.citas.confirmacionReprogramacion', compact('cita'));
    }



    // public function reschedule($id)
    // {
        
    //     $cita = DB::table('citas')->where('id', $id)->first();

    //     // Obtener las disponibilidades del médico con la misma especialidad en septiembre
    //     $disponibilidades = DB::table('disponibilidad_medicos as dm')
    //         ->join('medico_especialidades as me', 'dm.medicoId', '=', 'me.medicoId')
    //         ->where('me.especialidadId', $cita->especialidad_id)
    //         ->where('dm.medicoId', $cita->medicoId)
    //         ->where('dm.disponible', 1) // Solo mostrar horarios disponibles
           
    //         ->select('dm.medicoId', 'dm.fecha', 'dm.horaInicio', 'dm.horaFin', 'dm.disponible', 'me.especialidadId')
    //         ->get();

    //     return view('admin.citas.reschedule', compact('cita', 'disponibilidades'));
        
    //     // Lógica para reprogramar citas
    //     //return view('admin.citas.reschedule');
    // }


    // public function update(Request $request, $id)
    // {
    //     $cita = DB::table('citas')->where('id', $id)->first();

    //     if ($cita) {
    //         // Validar que el nuevo horario esté disponible
    //         $disponible = DB::table('disponibilidad_medicos')
    //             ->where('medicoId', $cita->medicoId)
    //             ->where('fecha', $request->input('fecha'))
    //             ->where('horaInicio', explode(' - ', $request->input('horario'))[0])
    //             ->where('disponible', 1)
    //             ->first();

    //         if ($disponible) {
    //             // Actualizar la disponibilidad del horario anterior a "Disponible"
    //             DB::table('disponibilidad_medicos')
    //                 ->where('medicoId', $cita->medicoId)
    //                 ->where('fecha', $cita->fecha)
    //                 ->where('horaInicio', $cita->hora_inicio)
    //                 ->update(['disponible' => 1]);

    //             // Actualizar la disponibilidad del nuevo horario a "No Disponible"
    //             DB::table('disponibilidad_medicos')
    //                 ->where('medicoId', $cita->medicoId)
    //                 ->where('fecha', $request->input('fecha'))
    //                 ->where('horaInicio', explode(' - ', $request->input('horario'))[0])
    //                 ->update(['disponible' => 2]);

    //             // Actualizar la cita con la nueva fecha y horario
    //             DB::table('citas')
    //                 ->where('id', $id)
    //                 ->update([
    //                     'fecha' => $request->input('fecha'),
    //                     'hora_inicio' => explode(' - ', $request->input('horario'))[0],
    //                     'hora_fin' => explode(' - ', $request->input('horario'))[1],
    //                 ]);

    //             return redirect()->route('admin.citas.index')->with('success', 'Cita reprogramada exitosamente.');
    //         } else {
    //             return back()->with('error', 'El horario seleccionado no está disponible.');
    //         }
    //     }

    //     return back()->with('error', 'Cita no encontrada.');
    // }


    public function reprogramar($id)
    {
        $cita = DB::table('citas')->where('id', $id)->first();

        // Obtener disponibilidades del médico de la cita
        $disponibilidades = DB::table('disponibilidad_medicos')
            ->where('medicoId', $cita->medicoId)
            ->where('disponible', 1) // Disponibilidad
            ->where('fecha', '>=', now()->toDateString()) // Mostrar solo fechas desde hoy en adelante
            ->get();

        return view('admin.citas.reprogramar', compact('cita', 'disponibilidades'));
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
        
        $usuario = User::find($usuario_id);
        Log::info('Usuario encontrado: ' . json_encode($usuario));

        // Indicamos que queremos mostrar el calendario
        Log::info('Mostrando calendario');
        $calendario = true;

        // Retornar la vista de selección de médico, pero ahora con el calendario visible
        Log::info('Retornando vista con calendario');
        return view('admin.citas.seleccionar-medico', compact(
            'medico_id', 'usuario_id', 'medicos', 'calendario', 'especialidad_id'
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

    public function mostrarConfirmacion($cita_id)
        {
                // Obtener detalles de la cita mediante una consulta personalizada
                $cita = Cita::select('citas.id as cita_id', 'users.nombre as usuario_nombre', 'users.apellidos as usuario_apellidos', 
                'medicos.id as medico_id', 'mu.nombre as medico_nombre', 'mu.apellidos as medico_apellidos', 
                'especialidades_medicas.nombre as especialidad', 'citas.fecha as fecha_cita', 
                DB::raw("CONCAT(citas.hora_inicio, ' - ', citas.hora_fin) as horario_cita"))
                ->join('users', 'citas.pacienteId', '=', 'users.id')  // Relación con el usuario (paciente)
                ->join('medicos', 'citas.medicoId', '=', 'medicos.id')  // Relación con el médico
                ->join('users as mu', 'medicos.usuarioId', '=', 'mu.id')  // Relación del médico con el usuario
                ->join('especialidades_medicas', 'citas.especialidad_id', '=', 'especialidades_medicas.id')  // Relación con la especialidad médica
                ->where('citas.id', $cita_id)
                ->first();

                if (!$cita) {
                return redirect()->back()->with('error', 'Cita no encontrada.');
                }

                // Pasar los detalles de la cita a la vista de confirmación
                return view('admin.citas.confirmacion', [
                'usuario_nombre' => $cita->usuario_nombre,
                'usuario_apellidos' => $cita->usuario_apellidos,
                'medico_nombre' => $cita->medico_nombre,
                'medico_apellidos' => $cita->medico_apellidos,
                'especialidad' => $cita->especialidad,
                'fecha_cita' => $cita->fecha_cita,
                'horario_cita' => $cita->horario_cita,
                ]);
            
            
        
            
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
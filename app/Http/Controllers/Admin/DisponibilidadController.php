<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use App\Models\DisponibilidadMedico;
use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class DisponibilidadController extends Controller
{

    

    public function mostrarDisponibilidadDias($medicoId) // Usando medicoId directamente como parámetro
    {
        Log::info('Obteniendo disponibilidad por días para el médico ID: ' . $medicoId);

        try {
            // * Realizar la consulta utilizando el medicoId recibido
            $disponibilidades = DisponibilidadMedico::select('fecha', DB::raw('COUNT(*) as total_disponibilidades'))
                ->where('medicoId', $medicoId) // Usando medicoId directamente
                ->whereDate('fecha', '>=', date('Y-m-d')) // Disponibilidad futura
                ->where('disponible', true) // Filtrar por disponibilidad
                ->groupBy('fecha') // Agrupar resultados por fecha
                ->get();

            // Verificar si se obtuvieron resultados
            if ($disponibilidades->isEmpty()) {
                Log::warning('No se encontraron disponibilidades para el médico ID: ' . $medicoId);
                return response()->json(['error' => 'No se encontraron disponibilidades'], 404);
            }

            Log::info('Disponibilidades obtenidas con éxito para el médico ID: ' . $medicoId);
            
            // * Retornar la respuesta en formato JSON
            return response()->json($disponibilidades);
        } catch (\Exception $e) {
            // * Registrar el error y retornar un mensaje de error JSON
            Log::error('Error al obtener las disponibilidades: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener las disponibilidades'], 500);
        }
    }

    public function mostrarDisponibilidadDiasPorMedico($usuarioId)
    {
        // Primero, obtener el ID del médico desde la tabla 'medicos' usando 'usuarioId'
        Log::info('Obteniendo ID del médico desde la tabla medicos para usuario ID: ' . $usuarioId);
        
        $medico = Medico::where('usuarioId', $usuarioId)->first();  // Asegúrate de que esto sea correcto
        
        

        if ($medico) {
            $medicoId = $medico->id; // ID del médico desde la tabla 'medicos'
            Log::info('Médico encontrado con ID: ' . $medicoId);

            try {
                
                // Usar el ID del médico en la consulta de disponibilidad
                $disponibilidades = DisponibilidadMedico::select('fecha', DB::raw('COUNT(*) as total_disponibilidades'))
                    ->where('medicoId', $medicoId) // Usar el ID del médico de la tabla `disponibilidad_medicos`
                    ->whereDate('fecha', '>=', date('Y-m-d')) // Disponibilidad futura
                    ->where('disponible', true) // Filtrar por disponibilidad
                    ->groupBy('fecha') // Agrupar resultados por fecha
                    ->get();

                // Verificar si se obtuvieron resultados
                if ($disponibilidades->isEmpty()) {
                    Log::warning('No se encontraron disponibilidades para el médico ID: ' . $medicoId);
                    return response()->json(['error' => 'No se encontraron disponibilidades'], 404);
                }

                
                Log::info('Disponibilidades obtenidas con éxito para el médico ID: ' . $medicoId);
                Log::info('Disponibilidades obtenidas con éxito:', $disponibilidades->toArray());
                
                // * Retornar la respuesta en formato JSON
                return response()->json($disponibilidades);
            } catch (\Exception $e) {
                // * Registrar el error y retornar un mensaje de error JSON
                Log::error('Error al obtener las disponibilidades: ' . $e->getMessage());
                return response()->json(['error' => 'Error al obtener las disponibilidades'], 500);
            }
        } else {
            // * Manejar el caso donde no se encuentra el médico
            Log::warning('Médico no encontrado para usuario ID: ' . $usuarioId);
            return response()->json(['error' => 'Médico no encontrado'], 404);
        }
    }


    public function mostrarDisponibilidadHorarios($usuarioId, $fecha) 
{
    // Obtener el ID del médico desde la tabla 'medicos' usando 'usuarioId'
    Log::info('Obteniendo ID del médico desde la tabla medicos para usuario ID: ' . $usuarioId);
    
    $medico = Medico::where('usuarioId', $usuarioId)->first();

    if ($medico) {
        $medicoId = $medico->id; // ID del médico desde la tabla 'medicos'
        Log::info('Médico encontrado con ID: ' . $medicoId);

        // * Realizar la consulta para obtener las disponibilidades horarias
        try {
            $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
                ->where('fecha', $fecha)
                ->where('disponible', true)
                ->get();
    
            // * Verificar si no hay disponibilidades
            if ($disponibilidades->isEmpty()) {
                Log::warning('No hay disponibilidad para la fecha: ' . $fecha . ' para el médico ID: ' . $medicoId);
                return response()->json(['error' => 'No hay disponibilidad para esta fecha.'], 404);
            }
    
            // * Retornar la disponibilidad encontrada en formato JSON
            Log::info('Disponibilidades horarias obtenidas con éxito para el médico ID: ' . $medicoId);
            return response()->json($disponibilidades);
        } catch (\Exception $e) {
            // * Registrar el error y retornar un mensaje de error JSON
            Log::error('Error al obtener los horarios: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener los horarios'], 500);
        }
    } else {
        // * Manejar el caso donde no se encuentra el médico
        Log::warning('Médico no encontrado para usuario ID: ' . $usuarioId);
        return response()->json(['error' => 'Médico no encontrado'], 404);
    }
}


    

    
 
    // Método para reservar una cita
    public function reservarCita(Request $request)
    {
        $horario_id = $request->input('horario_id'); // Recibe el ID del horario (id en la tabla disponibilidad_medicos)
        $usuario_id = $request->input('usuario_id'); // Recibe el ID del usuario (id en la tabla users)
        $especialidad_id = $request->input('especialidad_id'); // Recibe el ID de la especialidad (id en la tabla especialidades_medicas)

        // * Registrar en el log los datos recibidos de la solicitud
        Log::info('Datos recibidos para reserva de cita', ['horario_id' => $horario_id, 'usuario_id' => $usuario_id, 'especialidad_id' => $especialidad_id]);

        try {
            // ! Buscar la disponibilidad del horario en la base de datos utilizando el ID proporcionado
            $disponibilidad = DisponibilidadMedico::findOrFail($horario_id); // Utiliza findOrFail para simplificar

            // ? Verificar si el horario ya está reservado (disponible = 1 significa disponible)
            if ($disponibilidad->disponible != 1) {
                // ? Si el horario no está disponible, se devuelve un mensaje de error
                return response()->json(['success' => false, 'message' => 'El horario ya está reservado.']);
            }

            DB::beginTransaction(); // * Inicia una transacción de base de datos

            // * Marcar el horario como no disponible
            $disponibilidad->disponible = 2; // Cambiar el estado a 2 para indicar que no está disponible
            $disponibilidad->save(); // * Guardar los cambios en la base de datos

            // * Log después de cambiar la disponibilidad
            Log::info('Disponibilidad marcada como no disponible', ['horario_id' => $horario_id]);

            // TODO: Crear una nueva cita con la información proporcionada
            $cita = new Cita();
            $cita->pacienteId = $usuario_id; // En tabla citas, pacienteId es el ID del usuario
            $cita->medicoId = $disponibilidad->medicoId; // * Asigna el ID del médico del horario
            $cita->especialidad_id = $especialidad_id; // * Asigna la especialidad de la disponibilidad
            $cita->fecha = $disponibilidad->fecha; // * Fecha de la cita
            $cita->hora_inicio = $disponibilidad->horaInicio; // * Hora de inicio de la cita
            $cita->hora_fin = $disponibilidad->horaFin; // * Hora de fin de la cita
            $cita->estado = 'Agendada'; // * Estado por defecto al agendar
            $cita->save(); // * Guardar la nueva cita en la base de datos

            // * Log después de guardar la cita
            Log::info('Cita creada exitosamente', ['cita_id' => $cita->id]);

            DB::commit(); // * Confirmar la transacción de la base de datos

            // * Devolver una respuesta de éxito con el ID de la cita
            return response()->json(['success' => true, 'message' => 'Cita agendada con éxito.', 'cita_id' => $cita->id]);

        } catch (\Exception $e) {
            DB::rollBack(); // * Revertir la transacción en caso de error
            Log::error('Error al reservar la cita:', ['error' => $e->getMessage()]); // * Log del error
            // ? Manejo de errores generales y devolución de mensaje de error
            return response()->json(['success' => false, 'message' => 'Error al reservar la cita.']);
        }
    }

    
}

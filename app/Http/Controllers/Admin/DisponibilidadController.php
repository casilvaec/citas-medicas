<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use App\Models\DisponibilidadMedico;
use Illuminate\Http\Request;
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


    // public function mostrarDisponibilidadHorarios($medicoId, $fecha) // Cambio en el parámetro: $medicoId en lugar de $usuarioId
    // {
    //     Log::info('Obteniendo disponibilidad de horarios para médico ID: ' . $medicoId . ' en la fecha: ' . $fecha);
    
    //     // * Realizar la consulta para obtener las disponibilidades horarias
    //     try {
    //         $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId) // Usando medicoId directamente
    //             ->where('fecha', $fecha)
    //             ->where('disponible', true)
    //             ->get();
    
    //         // * Verificar si no hay disponibilidades
    //         if ($disponibilidades->isEmpty()) {
    //             Log::warning('No hay disponibilidad para la fecha: ' . $fecha . ' para el médico ID: ' . $medicoId);
    //             return response()->json(['error' => 'No hay disponibilidad para esta fecha.'], 404);
    //         }
    
    //         // * Retornar la disponibilidad encontrada en formato JSON
    //         Log::info('Disponibilidades horarias obtenidas con éxito para el médico ID: ' . $medicoId);
    //         return response()->json($disponibilidades);
    //     } catch (\Exception $e) {
    //         // * Registrar el error y retornar un mensaje de error JSON
    //         Log::error('Error al obtener los horarios: ' . $e->getMessage());
    //         return response()->json(['error' => 'Error al obtener los horarios'], 500);
    //     }
    // }
    

    
    // Método para reservar una cita
    public function reservarCita(Request $request)
    {
        $disponibilidad = DisponibilidadMedico::where('medicoId', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('horaInicio', $request->horaInicio)
            ->first();

        if ($disponibilidad) {
            $disponibilidad->disponible = false;
            $disponibilidad->save();

            return response()->json(['success' => true, 'message' => 'Cita reservada exitosamente']);
        }

        return response()->json(['success' => false, 'message' => 'Error al reservar la cita'], 400);
    }
    
}

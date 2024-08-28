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

    // public function mostrarDisponibilidadDias($medico_id)
    // {
    //     //dd('Entrando a mostrarDisponibilidadDias');
    //     //dd($medico_id);
    //     try {
    //         // Realizar la consulta a la base de datos
    //         $disponibilidades = DisponibilidadMedico::select('fecha', DB::raw('COUNT(*) as total_disponibilidades'))
    //             ->where('medicoId', $medico_id)
    //             ->where('disponible', true)
    //             ->groupBy('fecha')
    //             ->get();

    //         // Retornar la respuesta en formato JSON
    //         return response()->json($disponibilidades);
    //     } catch (\Exception $e) {
    //         // Registrar el error y retornar un mensaje de error JSON
    //         Log::error('Error al obtener las disponibilidades: ' . $e->getMessage());
    //         return response()->json(['error' => 'Error al obtener las disponibilidades'], 500);
    //     }
    // }

    // public function seleccionarMedico($usuarioId)
    // {
    //     // Obtener el ID del médico basado en el ID del usuario
    //     $medico = Medico::where('usuarioId', $usuarioId)->first();

    //     // Verificar si el médico existe
    //     if ($medico) {
    //         $medicoId = $medico->id;
    //         dd($medicoId); // Detiene la ejecución y muestra el ID del médico

    //         // Pasar el ID del médico a la vista
    //         return view('admin.citas.seleccionar-medico', compact('medicoId'));
    //     } else {
    //         // Manejar el caso donde no se encuentra el médico
    //         return redirect()->back()->with('error', 'Médico no encontrado');
    //     }
    // }

    // Método para mostrar la disponibilidad de días de un médico
    public function mostrarDisponibilidadDias($usuarioId)
    {
        // * Obtener el ID del médico basado en el ID del usuario
        Log::info('Obteniendo ID del médico para usuario ID: ' . $usuarioId);
        $medico = Medico::where('usuarioId', $usuarioId)->first();

        // * Verificar si el médico existe
        if ($medico) {
            $medicoId = $medico->id;
            Log::info('Médico encontrado con ID: ' . $medicoId);

            try {
                // * Realizar la consulta utilizando el medicoId obtenido
                $disponibilidades = DisponibilidadMedico::select('fecha', DB::raw('COUNT(*) as total_disponibilidades'))
                    ->where('medicoId', $medicoId) // Usar el ID del médico
                    ->where('disponible', true) // Filtrar por disponibilidad
                    ->groupBy('fecha') // Agrupar resultados por fecha
                    ->get();

                 // * Pasar el ID del médico a la vista (sin reemplazar la respuesta JSON)
                session()->put('medico_id', $medicoId);
                Log::info('Disponibilidades obtenidas con éxito');
                
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

    // Método para mostrar la disponibilidad horaria en un día específico
    public function mostrarDisponibilidadHorarios($usuarioId, $fecha)
    {
        // * Obtener el ID del médico basado en el ID del usuario
        Log::info('Obteniendo ID del médico para usuario ID: ' . $usuarioId);
        $medico = Medico::where('usuarioId', $usuarioId)->first();
        

        if ($medico) {
            $medicoId = $medico->id; // * Este es el ID del médico que necesitamos para las consultas
            Log::info('Médico encontrado con ID: ' . $medicoId);

            // * Realizar la consulta para obtener las disponibilidades horarias
            try {
                Log::info('Consultando disponibilidades horarias para médico ID: ' . $medicoId . ' y fecha: ' . $fecha);
                $disponibilidades = DisponibilidadMedico::where('medicoId', $medicoId)
                    ->where('fecha', $fecha)
                    ->where('disponible', true)
                    ->get();

                // * Verificar si no hay disponibilidades
                if ($disponibilidades->isEmpty()) {
                    Log::warning('No hay disponibilidad para la fecha: ' . $fecha);
                    return response()->json(['error' => 'No hay disponibilidad para esta fecha.'], 404);
                }

                // * Retornar la disponibilidad encontrada en formato JSON
                Log::info('Disponibilidades horarias obtenidas con éxito');
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



    // Método para mostrar la disponibilidad horaria en un día específico
    // public function mostrarDisponibilidadHorarios($medico_id, $fecha)
    // {
    //     //dd($fecha);
    //     $disponibilidades = DisponibilidadMedico::where('medicoId', $medico_id)
    //         ->where('fecha', $fecha)
    //         ->where('disponible', true)
    //         ->get();

    //         //dd($disponibilidades);
            
    //     return response()->json($disponibilidades);
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

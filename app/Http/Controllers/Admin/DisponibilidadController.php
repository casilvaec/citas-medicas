<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DisponibilidadMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DisponibilidadController extends Controller
{

    // * Método para generar disponibilidad masiva para un médico en los próximos X meses
    public function generarDisponibilidadMasiva($medico_id, $meses = 6) // Puedes ajustar los meses aquí
    {
        // * Obtener los horarios por defecto asignados al médico desde la tabla horarios_medicos
        $horariosDefecto = DB::table('horarios_medicos')
            ->where('medicoId', $medico_id)
            ->get();

        // * Generar las fechas para los próximos X meses
        $fechaInicio = new \DateTime();
        $fechaFin = (new \DateTime())->modify("+{$meses} months");

        // * Iterar sobre cada día en el rango de fechas
        while ($fechaInicio <= $fechaFin) {
            $diaSemana = $fechaInicio->format('N'); // Lunes = 1, Domingo = 7

            // * Solo crear disponibilidad para días laborables (lunes a viernes)
            if ($diaSemana <= 5) {
                foreach ($horariosDefecto as $horario) {
                    $horaActual = strtotime($horario->horaInicio);
                    $horaFin = strtotime($horario->horaFin);

                    while ($horaActual < $horaFin) {
                        $horaInicio = date('H:i:s', $horaActual);
                        $horaSiguiente = date('H:i:s', strtotime('+30 minutes', $horaActual));

                        // ! Verifica si ya existe una entrada de disponibilidad para ese horario en la fecha dada
                        $existeDisponibilidad = DisponibilidadMedico::where('medico_id', $medico_id)
                            ->where('fecha', $fechaInicio->format('Y-m-d'))
                            ->where('horaInicio', $horaInicio)
                            ->exists();

                        // * Si no existe, la crea
                        if (!$existeDisponibilidad) {
                            DisponibilidadMedico::create([
                                'medico_id' => $medico_id,
                                'fecha' => $fechaInicio->format('Y-m-d'),
                                'horaInicio' => $horaInicio,
                                'horaFin' => $horaSiguiente,
                                'disponible' => true,
                            ]);
                        }

                        $horaActual = strtotime('+30 minutes', $horaActual);
                    }
                }
            }

            // * Avanzar al siguiente día
            $fechaInicio->modify('+1 day');
        }

        // No se retorna ningún mensaje, ya que esto es un proceso interno
    }

    // * Método para mostrar las disponibilidades de un médico específico en una fecha determinada
    public function mostrarDisponibilidad($medico_id, $fecha)
    {
        // * Obtener la disponibilidad actualizada para la fecha dada
        $disponibilidades = DisponibilidadMedico::where('medico_id', $medico_id)
            ->where('fecha', $fecha)
            ->where('disponible', true)
            ->get();

        // * Retornar la disponibilidad como respuesta en formato JSON
        return response()->json($disponibilidades);
    }

    // * Método para reservar una cita, marcando el horario como no disponible
    public function reservarCita(Request $request)
    {
        // ? Busca la disponibilidad específica del médico en la fecha y hora dadas
        $disponibilidad = DisponibilidadMedico::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('horaInicio', $request->horaInicio)
            ->first();

        // ! Si se encuentra la disponibilidad, se marca como no disponible
        if ($disponibilidad) {
            $disponibilidad->disponible = false;
            $disponibilidad->save();

            // * Retorna un mensaje de éxito y los detalles de la cita reservada
            return response()->json(['success' => true, 'message' => 'Cita reservada exitosamente', 'cita' => $disponibilidad]);
        }

        // ! Si no se encuentra la disponibilidad, retorna un mensaje de error
        return response()->json(['success' => false, 'message' => 'Error al reservar la cita'], 400);
    }
    // * Método para marcar un horario como no disponible
    // * Método para mostrar las disponibilidades de un médico específico en una fecha determinada
    // public function mostrarDisponibilidad($medico_id, $fecha)
    // {
    //     // * Obtener los horarios por defecto asignados al médico desde la tabla horarios_medicos
    //     $horariosDefecto = DB::table('horarios_medicos')
    //         ->where('medicoId', $medico_id)
    //         ->get();

    //     // * Crear entradas de disponibilidad en la tabla disponibilidad_medicos si no existen para la fecha dada
    //     foreach ($horariosDefecto as $horario) {
    //         // * Verifica si ya existe una entrada de disponibilidad para ese horario en la fecha dada
    //         $existeDisponibilidad = DisponibilidadMedico::where('medico_id', $medico_id)
    //             ->where('fecha', $fecha)
    //             ->where('horaInicio', $horario->horaInicio)
    //             ->exists();

    //         // * Si no existe, la crea
    //         if (!$existeDisponibilidad) {
    //             DisponibilidadMedico::create([
    //                 'medico_id' => $medico_id,
    //                 'fecha' => $fecha,
    //                 'horaInicio' => $horario->horaInicio,
    //                 'horaFin' => $horario->horaFin,
    //                 'disponible' => true,
    //             ]);
    //         }
    //     }

    //     // * Obtener la disponibilidad actualizada para la fecha dada
    //     $disponibilidades = DisponibilidadMedico::where('medico_id', $medico_id)
    //         ->where('fecha', $fecha)
    //         ->where('disponible', true)
    //         ->get();

    //     // * Retornar la disponibilidad como respuesta en formato JSON
    //     return response()->json($disponibilidades);
    // }

    // * Método para marcar un horario como no disponible
    // public function reservarHorario(Request $request)
    // {
    //     // * Busca la disponibilidad específica del médico en la fecha y hora dadas
    //     $disponibilidad = DisponibilidadMedico::where('medico_id', $request->medico_id)
    //         ->where('fecha', $request->fecha)
    //         ->where('horaInicio', $request->horaInicio)
    //         ->first();

    //     // * Si se encuentra la disponibilidad, se marca como no disponible
    //     if ($disponibilidad) {
    //         $disponibilidad->disponible = false;
    //         $disponibilidad->save();

    //         // * Retorna un mensaje de éxito
    //         return response()->json(['message' => 'Horario reservado exitosamente']);
    //     }

    //     // * Si no se encuentra la disponibilidad, retorna un mensaje de error
    //     return response()->json(['message' => 'Error al reservar el horario'], 400);
    // }
}

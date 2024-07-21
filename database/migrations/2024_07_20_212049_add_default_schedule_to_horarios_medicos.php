<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Medico;
use App\Models\HorarioMedico;

class AddDefaultScheduleToHorariosMedicos extends Migration
{
    public function up()
    {
        $medicos = Medico::all();
        foreach ($medicos as $medico) {
            for ($dia = 1; $dia <= 5; $dia++) {
                HorarioMedico::create([
                    'medicoId' => $medico->id,
                    'diaSemana' => $dia,
                    'horaInicio' => '09:00',
                    'horaFin' => '12:00'
                ]);

                HorarioMedico::create([
                    'medicoId' => $medico->id,
                    'diaSemana' => $dia,
                    'horaInicio' => '16:00',
                    'horaFin' => '18:00'
                ]);
            }
        }
    }

    public function down()
    {
        HorarioMedico::where('horaInicio', '09:00')->where('horaFin', '12:00')->delete();
        HorarioMedico::where('horaInicio', '16:00')->where('horaFin', '18:00')->delete();
    }
}

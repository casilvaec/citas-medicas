<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMedico extends Model
{
    use HasFactory;

    protected $fillable = ['medicoId', 'diaSemana', 'horaInicio', 'horaFin'];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medicoId');
    }
}

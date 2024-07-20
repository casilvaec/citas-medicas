<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisponibilidadMedico extends Model
{
    use HasFactory;

    protected $fillable = ['medicoId', 'fecha', 'horaInicio', 'horaFin', 'disponible'];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medicoId');
    }
}

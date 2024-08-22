<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisponibilidadMedico extends Model
{
    use HasFactory;

    protected $table = 'disponibilidad_medicos';

    protected $fillable = [
        'medico_id',
        'fecha',
        'horaInicio',
        'horaFin',
        'disponible',
    ];

    // Relación con el modelo Medico
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}

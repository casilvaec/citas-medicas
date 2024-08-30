<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMedico extends Model
{
    use HasFactory;

    protected $table = 'horarios_medicos';

    protected $fillable = ['medicoId', 'fecha', 'horaInicio', 'horaFin'];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medicoId')->onDelete('cascade');
    }
}

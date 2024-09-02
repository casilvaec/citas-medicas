<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $fillable = ['pacienteId', 'citaId', 'fechaHora', 'diagnostico', 'examenes', 'receta', 'proximoControl'];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'pacienteId');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'citaId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triaje extends Model
{
    use HasFactory;

    // Definir la relación con el paciente (usuario)
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacienteId');
    }
}

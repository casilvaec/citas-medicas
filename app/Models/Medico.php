<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = ['usuarioId', 'especialidad_id'];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }

    // Relación con el modelo Especialidad
    public function especialidades()
    {
        return $this->belongsToMany(EspecialidadesMedicas::class, 'medico_especialidades', 'medicoId', 'especialidadId');
    }
}

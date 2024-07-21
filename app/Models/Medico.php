<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = ['usuarioId', 'especialidadId'];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }

    public function especialidades()
    {
        return $this->belongsToMany(EspecialidadesMedicas::class, 'medico_especialidades', 'medicoId', 'especialidadId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecialidadesMedicas extends Model
{
    use HasFactory;

    protected $table = 'especialidades_medicas';

    protected $fillable = ['nombre', 'descripcion', 'estado'];

    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'medico_especialidades', 'especialidadId', 'medicoId')->onDelete('cascade');
    }
}

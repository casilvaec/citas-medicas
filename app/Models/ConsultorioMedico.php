<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultorioMedico extends Model
{
    use HasFactory;

    protected $table = 'consultorio_medico'; // Nombre correcto de la tabla

    protected $fillable = ['consultorio_id', 'medico_id', 'fecha_asignacion'];

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class, 'consultorio_id');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}

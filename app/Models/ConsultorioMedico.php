<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultorioMedico extends Model
{
    use HasFactory;

    protected $table = 'consultorio_medico';

    protected $fillable = [
        'consultorio_id', 'medico_id', 'fecha_asignacion',
    ];

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}

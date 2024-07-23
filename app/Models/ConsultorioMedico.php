<?php 

// app/Models/ConsultorioMedico.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultorioMedico extends Model
{
    use HasFactory;

    protected $table = 'consultorio_medico';

    protected $fillable = ['consultorioId', 'medicoId', 'fecha_asignacion'];

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class, 'consultorioId');
    }

    public function medico()
    {
        return $this->belongsTo(User::class, 'medicoId');
    }
}

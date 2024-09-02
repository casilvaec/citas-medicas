<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;

    // Especifica el nombre correcto de la tabla en la base de datos
    protected $table = 'historiasclinicas';

    protected $fillable = ['pacienteId', 'citaId', 'fechaHora', 'diagnostico', 'examenes', 'receta', 'proximoControl'];


    /**
     * Relación con el modelo User (paciente).
     * Cada historia clínica pertenece a un paciente.
     */
    public function paciente()
    {
        return $this->belongsTo(User::class, 'pacienteId');
    }


    /**
     * Relación con el modelo Cita.
     * Cada historia clínica está asociada a una cita.
     */
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'citaId');
    }
}

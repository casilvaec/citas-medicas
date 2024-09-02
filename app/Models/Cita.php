<?php




namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'pacienteId', 'medicoId', 'especialidad_id', 'fecha', 'hora_inicio', 'hora_fin', 'estado'
    ];

    // public function paciente()
    // {
    //     return $this->belongsTo(User::class, 'pacienteId');
    // }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }


    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medicoId');
    }

    public function especialidad()
    {
        return $this->belongsTo(EspecialidadesMedicas::class, 'especialidad_id');
    }
}

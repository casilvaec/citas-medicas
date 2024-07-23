<?php 

// app/Models/Consultorio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'nombre', 'descripcion', 'ubicacion', 'estado'];

    public function medicos()
    {
        return $this->belongsToMany(User::class, 'consultorio_medico', 'consultorioId', 'medicoId')
                    ->withPivot('fecha_asignacion');
    }
}


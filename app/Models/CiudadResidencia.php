<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiudadResidencia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Define el nombre correcto de la tabla
    protected $table = 'ciudades';
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    protected $table = 'auditores'; // Especifica el nombre correcto de la tabla
    
    protected $fillable = ['usuarioId'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }
}
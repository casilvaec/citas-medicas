<?php

// namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable; -->

// class User extends Authenticatable
// {
//     use HasFactory, Notifiable;

//     protected $fillable = [
//         'nombre',
//         'correoElectronico',
//         'password',
//         'tipoIdentificacionId',
//         'fechaNacimiento',
//         'generoId',
//         'telefono',
//         'direccion',
//         'ciudadResidenciaId',
//         'estado',
//     ];

//     protected $hidden = [
//         'password',
//     ];

//     public function getEmailAttribute()
//     {
//         return $this->attributes['correoElectronico'];
//     }

//     public function setEmailAttribute($value)
//     {
//         $this->attributes['correoElectronico'] = $value;
//     }
// } -->




namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nombre',
        'apellidos',
        'correoElectronico',
        'password',
        'tipoIdentificacionId',
        'fechaNacimiento',
        'generoId',
        'telefono',
        'direccion',
        'ciudadResidenciaId',
        'estadoId',
    ];

    protected $hidden = [
        'password',
    ];

    public function getEmailAttribute()
    {
        return $this->attributes['correoElectronico'];
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['correoElectronico'] = $value;
    }

    public function estadoUsuario()
    {
    return $this->belongsTo(EstadoUsuario::class, 'estadoId');
    }

}



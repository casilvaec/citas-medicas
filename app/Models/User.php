<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',                 // Cambiado de 'name' a 'nombre'
        'apellidos',               // Añadido campo 'apellido'
        'correoElectronico',      // Actualizado para reflejar el nombre correcto del campo
        'password',
        'tipoIdentificacion',
        'identificacion',
        'idGenero',
        'fechaNacimiento',
        'telefonoConvencional',
        'telefonoCelular',
        'direccion',
        'idCiudadResidencia',
        'idEstadoUsuario',
    ];

    /**
     * Los atributos que deben estar ocultos para los arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Obtener el estado del usuario.
     */
    public function estadoUsuario()
    {
        return $this->belongsTo(EstadoUsuario::class, 'idEstadoUsuario');
    }

    /**
     * Obtener el correo electrónico para restablecer la contraseña.
     */
    public function getEmailForPasswordReset()
    {
        return $this->correoElectronico;
    }

    /**
     * Obtener el correo electrónico para la verificación.
     */
    public function getEmailForVerification()
    {
        return $this->correoElectronico;
    }
}

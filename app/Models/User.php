<?php






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
        'username',
        'password',
        'tipoIdentificacionId',
        'fechaNacimiento',
        'generoId',
        'telefonoConvencional',
        'telefonoCelular',
        'direccion',
        'ciudadResidenciaId',
        'estadoId',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Método para acceder al atributo email como correoElectronico
    public function getEmailAttribute()
    {
        return $this->attributes['correoElectronico'];
    }

    // Método para asignar el atributo email a correoElectronico
    public function setEmailAttribute($value)
    {
        $this->attributes['correoElectronico'] = $value;
    }

    // Relación con el modelo EstadoUsuario
    public function estadoUsuario()
    {
        return $this->belongsTo(EstadoUsuario::class, 'estadoId');
    }

    // Relación con el modelo Consultorio a través de la tabla pivote consultorio_medico
    public function consultorios()
    {
        return $this->belongsToMany(Consultorio::class, 'consultorio_medico', 'medicoId', 'consultorioId')
                    ->withPivot('fecha_asignacion');
    }


    public function genero()
    {
        return $this->belongsTo(Genero::class, 'generoId');
    }

}


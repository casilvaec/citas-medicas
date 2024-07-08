<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role; // Importar el modelo Role
use Laravel\Fortify\Rules\Password; // Asegúrate de importar las reglas de contraseña si no están

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'nombre' => $input['nombre'],
            'apellidos' => $input['apellidos'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'estado' => 0, // Estado inactivo por defecto
        ]);

        // Asignar rol de paciente
        $role = Role::where('name', 'paciente')->first();
        $user->assignRole($role);

        // Guardar datos en la sesión
        session(['registro_inicial' => $user->id]);

        return $user;
    }
}

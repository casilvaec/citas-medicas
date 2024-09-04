<?php




namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\View;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Muestra el formulario de registro de la aplicación.
     *
     * @return \Illuminate\View\View
     */
    public function create(): ViewContract
    {
        return view('auth.register');
    }

    /**
     * Maneja una solicitud de registro inicial para la aplicación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correoElectronico' => ['required', 'string', 'email', 'max:255', 'unique:users,correoElectronico'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'], // Validación para el campo username
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Crear un nuevo usuario
        $user = User::create([
            'nombre' => $request->name,
            'apellidos' => $request->apellidos,
            'correoElectronico' => $request->correoElectronico,
            'username' => $request->username, // Asignar el valor del username
            'password' => Hash::make($request->password),
            'estadoId' => 1, // Estado inactivo por defecto
        ]);

        // Asignar el rol 'paciente' al nuevo usuario
        $role = Role::where('name', 'paciente')->first();
        if ($role) {
            $user->assignRole($role);
        } else {
            // Manejar el caso en que el rol 'paciente' no exista
            return redirect()->route('register')->withErrors(['msg' => 'El rol de paciente no existe.']);
        }

        // Crear un registro en la tabla pacientes
        DB::table('pacientes')->insert([
            'usuarioId' => $user->id,
            'estado' => 1, // Estado inicial
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Disparar el evento Registered después de crear el usuario
        event(new Registered($user));

        // Autenticar al usuario recién registrado
        Auth::login($user);

        // Redirigir a la ruta de completar el perfil
        return redirect()->route('profile.edit');
    }
}

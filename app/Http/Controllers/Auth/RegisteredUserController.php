<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Guarda los datos de registro inicial en la sesión
        session([
            'registro_inicial' => [
                'name' => $request->name,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Almacena la contraseña hasheada
            ]
        ]);

        return redirect()->route('register.complete');
    }

    /**
     * Display the complete registration form.
     */
    public function showCompleteForm(): View
    {
        // Verifica si los datos de registro inicial existen en la sesión
        if (!session()->has('registro_inicial')) {
            return redirect()->route('register');
        }

        return view('auth.register_complete', ['datos' => session('registro_inicial')]);
    }

    /**
     * Handle the completion of the registration.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function completeRegistration(Request $request)
    {
        $request->validate([
            'tipoIdentificacion' => ['required', 'string', 'max:255'],
            'identificacion' => ['required', 'string', 'max:255'],
            'idGenero' => ['required', 'integer'],
            'fechaNacimiento' => ['required', 'date'],
            'telefonoConvencional' => ['nullable', 'string', 'max:255', 'regex:/^[0-9]*$/'],
            'telefonoCelular' => ['nullable', 'string', 'max:255', 'regex:/^[0-9]*$/'],
            'direccion' => ['required', 'string', 'max:255'],
            'idCiudadResidencia' => ['required', 'integer'],
        ]);

        $registroInicial = session('registro_inicial');

        $user = Auth::user();
        $user->update([
            'tipoIdentificacion' => $request->tipoIdentificacion,
            'identificacion' => $request->identificacion,
            'idGenero' => $request->idGenero,
            'fechaNacimiento' => $request->fechaNacimiento,
            'telefonoConvencional' => $request->telefonoConvencional,
            'telefonoCelular' => $request->telefonoCelular,
            'direccion' => $request->direccion,
            'idCiudadResidencia' => $request->idCiudadResidencia,
            'idEstadoUsuario' => 2, // Estado activo después de completar el registro
        ]);

        return redirect()->route('dashboard'); // O la ruta que desees después de completar el registro
    }
}

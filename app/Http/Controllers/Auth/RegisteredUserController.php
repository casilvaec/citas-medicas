<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'idEstadoUsuario' => 1, // Estado inactivo por defecto
        ]);

        $role = Role::where('name', 'paciente')->first();
        $user->assignRole($role);

        session(['registro_inicial' => $request->only(['name', 'apellidos', 'email'])]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('register.complete');
    }

    public function showCompleteForm(): View
    {
        if (!session()->has('registro_inicial')) {
            return redirect()->route('register');
        }

        $tiposIdentificacion = DB::table('tipos_identificacion')->get();
        $generos = DB::table('generos')->get();
        $ciudades = DB::table('ciudad_residencias')->get();

        return view('auth.register_complete', [
            'datos' => session('registro_inicial'),
            'tiposIdentificacion' => $tiposIdentificacion,
            'generos' => $generos,
            'ciudades' => $ciudades
        ]);
    }

    public function completeRegistration(Request $request)
    {
        $request->validate([
            'tipoIdentificacion' => ['required', 'string', 'max:255'],
            'identificacion' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20'],
            'idGenero' => ['required', 'integer'],
            'fechaNacimiento' => ['required', 'date'],
            'telefonoConvencional' => ['nullable', 'string', 'max:255'],
            'telefonoCelular' => ['nullable', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'idCiudadResidencia' => ['required', 'integer'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('register');
        }

        $user = User::find($user->id);
        if ($user) {
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
        } else {
            return redirect()->route('register');
        }

        return redirect()->route('dashboard');
    }
}

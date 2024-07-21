<?php

//namespace App\Http\Controllers\Auth;

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;
// use Spatie\Permission\Models\Role; -->

// class RegisteredUserController extends Controller
// {
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'apellidos' => ['required', 'string', 'max:255'],
//             'correoElectronico' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         $user = User::create([
//             'nombre' => $request->name,
//             'apellidos' => $request->apellidos,
//             'correoElectronico' => $request->email,
//             'password' => Hash::make($request->password),
//             'idEstadoUsuario' => 1, // Estado inactivo por defecto
//         ]);

//         $role = Role::where('nombre', 'paciente')->first();
//         $user->assignRole($role);

//         session(['registro_inicial' => $request->only(['name', 'apellidos', 'email'])]);

//         event(new Registered($user));

//         Auth::login($user);

//         return redirect()->route('register.complete');
//     }

//     public function showCompleteForm(): View
//     {
//         if (!session()->has('registro_inicial')) {
//             return redirect()->route('register');
//         }

//         $tiposIdentificacion = DB::table('tipos_identificacion')->get();
//         $generos = DB::table('generos')->get();
//         $ciudades = DB::table('ciudad_residencias')->get();

//         return view('auth.register_complete', [
//             'datos' => session('registro_inicial'),
//             'tiposIdentificacion' => $tiposIdentificacion,
//             'generos' => $generos,
//             'ciudades' => $ciudades
//         ]);
//     }

//     public function completeRegistration(Request $request)
//     {
//         $request->validate([
//             'tipoIdentificacion' => ['required', 'string', 'max:255'],
//             'identificacion' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20'],
//             'idGenero' => ['required', 'integer'],
//             'fechaNacimiento' => ['required', 'date'],
//             'telefonoConvencional' => ['nullable', 'string', 'max:255'],
//             'telefonoCelular' => ['nullable', 'string', 'max:255'],
//             'direccion' => ['required', 'string', 'max:255'],
//             'idCiudadResidencia' => ['required', 'integer'],
//         ]);

//         $user = Auth::user();

//         if (!$user) {
//             return redirect()->route('register');
//         }

//         $user = User::find($user->id);
//         if ($user) {
//             $user->update([
//                 'tipoIdentificacion' => $request->tipoIdentificacion,
//                 'identificacion' => $request->identificacion,
//                 'idGenero' => $request->idGenero,
//                 'fechaNacimiento' => $request->fechaNacimiento,
//                 'telefonoConvencional' => $request->telefonoConvencional,
//                 'telefonoCelular' => $request->telefonoCelular,
//                 'direccion' => $request->direccion,
//                 'idCiudadResidencia' => $request->idCiudadResidencia,
//                 'idEstadoUsuario' => 2, // Estado activo después de completar el registro
//             ]);
//         } else {
//             return redirect()->route('register');
//         }

//         return redirect()->route('dashboard');
//     }
// } -->







// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;
// use Spatie\Permission\Models\Role;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Muestra el formulario de registro de la aplicación.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Maneja una solicitud de registro inicial para la aplicación.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function store(Request $request)
//     {
//         // Validar los datos de entrada
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'apellidos' => ['required', 'string', 'max:255'],
//             'correoElectronico' => ['required', 'string', 'email', 'max:255', 'unique:users,correoElectronico'],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         // Crear un nuevo usuario
//         $user = User::create([
//             'nombre' => $request->name,
//             'apellidos' => $request->apellidos,
//             'correoElectronico' => $request->correoElectronico,
//             'password' => Hash::make($request->password),
//             'idEstadoUsuario' => 1, // Estado inactivo por defecto
//         ]);

//         // Asignar el rol 'paciente' al nuevo usuario
//         $role = Role::where('nombre', 'paciente')->first(); // Corregir el nombre del campo a 'name'
//         $user->assignRole($role);

//         // Guardar datos iniciales de registro en la sesión
//         session(['registro_inicial' => $request->only(['name', 'apellidos', 'correoElectronico'])]);

//         // Disparar el evento Registered después de crear el usuario
//         event(new Registered($user));

//         // Autenticar al usuario recién registrado
//         Auth::login($user);

//         // Redirigir a la ruta de completar el registro
//         return redirect()->route('register.complete');
//     }

//     /**
//      * Muestra el formulario para completar el registro.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function showCompleteForm(): View
//     {
//         // Verificar si hay datos de registro inicial en la sesión
//         if (!session()->has('registro_inicial')) {
//             return redirect()->route('register');
//         }

//         // Obtener los datos necesarios para completar el formulario
//         $tiposIdentificacion = DB::table('tipos_identificacion')->get();
//         $generos = DB::table('generos')->get();
//         $ciudades = DB::table('ciudad_residencias')->get();

//         // Devolver la vista del formulario de completar registro
//         return view('auth.register_complete', [
//             'datos' => session('registro_inicial'),
//             'tiposIdentificacion' => $tiposIdentificacion,
//             'generos' => $generos,
//             'ciudades' => $ciudades
//         ]);
//     }

//     /**
//      * Maneja la solicitud para completar el registro.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function completeRegistration(Request $request)
//     {
//         // Validar los datos de entrada
//         $request->validate([
//             'tipoIdentificacion' => ['required', 'string', 'max:255'],
//             'identificacion' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20'],
//             'idGenero' => ['required', 'integer'],
//             'fechaNacimiento' => ['required', 'date'],
//             'telefonoConvencional' => ['nullable', 'string', 'max:255'],
//             'telefonoCelular' => ['nullable', 'string', 'max:255'],
//             'direccion' => ['required', 'string', 'max:255'],
//             'idCiudadResidencia' => ['required', 'integer'],
//         ]);

//         // Obtener el usuario autenticado
//         $user = Auth::user();

//         // Si no hay un usuario autenticado, redirigir al formulario de registro
//         if (!$user) {
//             return redirect()->route('register');
//         }

//         // Actualizar los datos del usuario en la base de datos
//         $user->update([
//             'tipoIdentificacion' => $request->tipoIdentificacion,
//             'identificacion' => $request->identificacion,
//             'idGenero' => $request->idGenero,
//             'fechaNacimiento' => $request->fechaNacimiento,
//             'telefonoConvencional' => $request->telefonoConvencional,
//             'telefonoCelular' => $request->telefonoCelular,
//             'direccion' => $request->direccion,
//             'idCiudadResidencia' => $request->idCiudadResidencia,
//             'idEstadoUsuario' => 2, // Estado activo después de completar el registro
//         ]);

//         // Redirigir al dashboard del usuario
//         return redirect()->route('dashboard');
//     }
// }





//namespace App\Http\Controllers\Auth;

//////////////////////////////////////
// ESTO VALIA ANTES
//////////////////////////////////////




// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;
// use Spatie\Permission\Models\Role;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Muestra el formulario de registro de la aplicación.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Maneja una solicitud de registro inicial para la aplicación.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function store(Request $request)
//     {
//         // Validar los datos de entrada
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'apellidos' => ['required', 'string', 'max:255'],
//             'correoElectronico' => ['required', 'string', 'email', 'max:255', 'unique:users,correoElectronico'],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         // Crear un nuevo usuario
//         $user = User::create([
//             'nombre' => $request->name,
//             'apellidos' => $request->apellidos,
//             'correoElectronico' => $request->correoElectronico,
//             'password' => Hash::make($request->password),
//             'estadoId' => 1, // Estado inactivo por defecto
//         ]);

//         // Asignar el rol 'paciente' al nuevo usuario
//         $role = Role::where('nombre', 'paciente')->first(); // Usar 'nombre' en lugar de 'name'
//         if ($role) {
//             $user->assignRole($role);
//         } else {
//             // Manejar el caso en que el rol 'paciente' no exista
//             return redirect()->route('register')->withErrors(['msg' => 'El rol de paciente no existe.']);
//         }

//         // Guardar datos iniciales de registro en la sesión
//         session(['registro_inicial' => $request->only(['name', 'apellidos', 'correoElectronico'])]);

//         // Disparar el evento Registered después de crear el usuario
//         event(new Registered($user));

//         // Autenticar al usuario recién registrado
//         Auth::login($user);

//         // Redirigir a la ruta de completar el registro
//         return redirect()->route('register.complete');
//     }

//     /**
//      * Muestra el formulario para completar el registro.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function showCompleteForm(): View
//     {
//         // Verificar si hay datos de registro inicial en la sesión
//         if (!session()->has('registro_inicial')) {
//             return redirect()->route('register');
//         }

//         // Obtener los datos necesarios para completar el formulario
//         $tiposIdentificacion = DB::table('tipos_identificacion')->get();
//         $generos = DB::table('generos')->get();
//         $ciudades = DB::table('ciudades')->get();

//         // Devolver la vista del formulario de completar registro
//         return view('auth.register_complete', [
//             'datos' => session('registro_inicial'),
//             'tiposIdentificacion' => $tiposIdentificacion,
//             'generos' => $generos,
//             'ciudades' => $ciudades
//         ]);
//     }

//     /**
//      * Maneja la solicitud para completar el registro.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function completeRegistration(Request $request)
//     {
//         // Validar los datos de entrada
//         $request->validate([
//             'tipoIdentificacion' => ['required', 'integer'],
//             'identificacion' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20'],
//             'idGenero' => ['required', 'integer'],
//             'fechaNacimiento' => ['required', 'date'],
//             'telefonoConvencional' => ['nullable', 'string', 'max:255'],
//             'telefonoCelular' => ['nullable', 'string', 'max:255'],
//             'direccion' => ['required', 'string', 'max:255'],
//             'idCiudadResidencia' => ['required', 'integer'],
//         ]);

//         // Obtener el usuario autenticado
//         $user = Auth::user();

//         // Si no hay un usuario autenticado, redirigir al formulario de registro
//         if (!$user) {
//             return redirect()->route('register');
//         }

//         // Actualizar los datos del usuario en la base de datos
//         $user->tipoIdentificacionId = $request->tipoIdentificacion;
//         $user->identificacion = $request->identificacion;
//         $user->generoId = $request->idGenero;
//         $user->fechaNacimiento = $request->fechaNacimiento;
//         $user->telefono = $request->telefonoConvencional ?? $request->telefonoCelular;
//         $user->direccion = $request->direccion;
//         $user->ciudadResidenciaId = $request->idCiudadResidencia;
//         $user->estadoId = 2; // Estado activo después de completar el registro
//         $user->save();


//         // // Actualizar los datos del usuario en la base de datos
//         // $user->update([
//         //     'tipoIdentificacionId' => $request->tipoIdentificacion,
//         //     'identificacion' => $request->identificacion,
//         //     'generoId' => $request->idGenero,
//         //     'fechaNacimiento' => $request->fechaNacimiento,
//         //     'telefonoConvencional' => $request->telefonoConvencional,
//         //     'telefonoCelular' => $request->telefonoCelular,
//         //     'direccion' => $request->direccion,
//         //     'ciudadResidenciaId' => $request->idCiudadResidencia,
//         //     'estadoId' => 2, // Estado activo después de completar el registro
//         // ]);





//         // Redirigir al dashboard del usuario
//         return redirect()->route('dashboard');
//     }
// }

///////////////////////////////////////////
// HASTA AQUI LLEGABA
///////////////////////////////////////////


///////////////////////////////////////////
// AQUI EMPIEZA OTRA PRUEBA
///////////////////////////////////////////


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

        // Disparar el evento Registered después de crear el usuario
        event(new Registered($user));

        // Autenticar al usuario recién registrado
        Auth::login($user);

        // Redirigir a la ruta de completar el perfil
        return redirect()->route('profile.edit');
    }
}

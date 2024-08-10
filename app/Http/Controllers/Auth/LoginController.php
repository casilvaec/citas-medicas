<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
    // Usar el trait AuthenticatesUsers para proporcionar la funcionalidad de autenticación
    //use AuthenticatesUsers;

    // Redirigir a esta ruta después de iniciar sesión
    protected $redirectTo = '/admin/dashboard';

    // Constructor para aplicar middleware
    public function __construct()
    {
        // Aplicar middleware guest para que solo usuarios no autenticados puedan acceder a estas rutas
        //$this->middleware('guest')->except('logout');
    }

    // Mostrar la vista de login
    public function showLoginForm()
    {
        // Retornar la vista auth.login
        return view('auth.login');
    }

    // Manejar el inicio de sesión
    public function login(Request $request)
    {

        // No validamos las credenciales, simplemente tomamos el usuario por el username
        $user = User::where('username', $request->input('username'))->first();

        // Si el usuario existe, procedemos a verificar el estado
        if ($user) {
            // Autenticar manualmente al usuario (sin verificar la contraseña)
            Auth::login($user);

            // Llamar al método authenticated para verificar su estado
            return $this->authenticated($request, $user);
        }

        // Si no se encuentra el usuario, redirigir de vuelta al login con un mensaje de error
        return redirect()->back()->withErrors([
            'username' => 'Usuario no encontrado.',
        ]);
        // Validar los datos del formulario de login
        //$this->validateLogin($request);

        // Verificar si hay demasiados intentos de inicio de sesión
        // if (method_exists($this, 'hasTooManyLoginAttempts') &&
        //     $this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

            // Enviar respuesta de bloqueo si hay demasiados intentos
            //return redirect($this->redirectTo);
            //$this->sendLockoutResponse($request);
        //}

        // Intentar iniciar sesión con las credenciales proporcionadas
        // if ($this->attemptLogin($request)) {
        //     // Si el inicio de sesión es exitoso, enviar respuesta de éxito
        //     return $this->sendLoginResponse($request);
       // }

        // Incrementar el contador de intentos de inicio de sesión fallidos
        //$this->incrementLoginAttempts($request);

        // Enviar una respuesta indicando que el inicio de sesión falló
        //return $this->sendFailedLoginResponse($request);
    }

    // Validar los datos del formulario de login
    // protected function validateLogin(Request $request)
    // {
    //     // Requerir que el nombre de usuario y la contraseña estén presentes y sean válidos
    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

    // Definir que el campo de nombre de usuario es 'username'
    // public function username()
    // {
    //     // Usar el campo 'username' como nombre de usuario
    //     return 'username';
    // }

    /**
     * Cerrar la sesión del usuario en la aplicación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Cerrar sesión
        //Auth::logout();

        // Invalidar la sesión
        //$request->session()->invalidate();

        // Regenerar el token de la sesión
        //$request->session()->regenerateToken();

        // Redirigir a la página de inicio de sesión después de cerrar sesión
        return redirect('/login');
    }

    /**
     * Método para manejar acciones después de autenticar al usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
    //     // Obtener los IDs de los roles
    //     $adminRoleId = 7;
    //     $patientRoleId = 1;
    //     // Otros roles pueden ser añadidos aquí si es necesario

    //     // Verificar si el estado del usuario es igual a 1
    if ($user->estadoId == 1) {
    //      Redirigir a la página de edición de perfil
            return redirect()->route('profile.edit');
    }

    //     Verificar si el estado del usuario es igual a 2
    if ($user->estadoId == 2) {
        return redirect()->route('admin.dashboard');
    //         // Redirección basada en el rol del usuario
    //if ($user->roles->contains($adminRoleId)) {
    //             return redirect()->route('admin.dashboard');
    //         } elseif ($user->roles->contains($patientRoleId)) {
    //             return redirect()->route('patient.dashboard');
    //         }
    //     }

    // Redirección por defecto
    
    }
    return redirect()->route('home');
}
}

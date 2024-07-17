<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// Remove the duplicate import statement
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Usar el trait AuthenticatesUsers para proporcionar la funcionalidad de autenticación
    use AuthenticatesUsers;

    // Redirigir a esta ruta después de iniciar sesión
    protected $redirectTo = '/dashboard';

    // Constructor para aplicar middleware
    public function __construct()
    {
        // Aplicar middleware guest para que solo usuarios no autenticados puedan acceder a estas rutas
        $this->middleware('guest')->except('logout');
    }

    // Mostrar la vista de login
    public function showLoginForm()
    {
        // Retornar la vista auth.login
        return view('auth.login');
    }

    // Manejar el inicio de sesión
    public function login(LoginRequest $request)
    {
        // Validar los datos del formulario de login
        $this->validateLogin($request);

        // Verificar si hay demasiados intentos de inicio de sesión
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            // Enviar respuesta de bloqueo si hay demasiados intentos
            return $this->sendLockoutResponse($request);
        }

        // Intentar iniciar sesión con las credenciales proporcionadas
        if ($this->attemptLogin($request)) {
            // Si el inicio de sesión es exitoso, enviar respuesta de éxito
            return $this->sendLoginResponse($request);
        }

        // Incrementar el contador de intentos de inicio de sesión fallidos
        $this->incrementLoginAttempts($request);

        // Enviar una respuesta indicando que el inicio de sesión falló
        return $this->sendFailedLoginResponse($request);
    }

    // Validar los datos del formulario de login
    protected function validateLogin(Request $request)
    {
        // Requerir que el correoElectronico y la contraseña estén presentes y sean válidos
        $request->validate([
            
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    // Definir que el campo de nombre de usuario es el correo electrónico
    public function username()
    {
        // Usar el campo correoElectronico como nombre de usuario
        return 'username';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); // Redirige a la página de inicio de sesión después de cerrar sesión
    }

    protected function authenticated(Request $request, $user)
    {
        // Verifica si el atributo estadoId del usuario autenticado es igual a 1
        if ($user->estadoId == 1) {
            // Si estadoId es igual a 1, redirige al usuario a la ruta 'register.complete'
            return redirect()->route('register.complete');
        }
    
        // Si estadoId no es igual a 1, redirige al usuario a la ruta que intentaba acceder antes de iniciar sesión
        // Si no hay una ruta específica, redirige a la ruta definida por $this->redirectPath()
        return redirect()->intended($this->redirectPath());
}

}
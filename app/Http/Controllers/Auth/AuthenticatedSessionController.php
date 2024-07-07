<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Importa la solicitud de login personalizada
use App\Providers\RouteServiceProvider; // Importa el proveedor de servicios de rutas
use Illuminate\Http\RedirectResponse; // Importa la clase de respuesta de redirección
use Illuminate\Http\Request; //Importa la clase de solicitud
use Illuminate\Support\Facades\Auth; // Importa la fachada de autenticación
use Illuminate\View\View; // mporta la clase de vistas

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión.
     */
    public function create(): View
    {
        return view('auth.login'); // / Devuelve la vista de login
    }

    /**
     * Maneja una solicitud de autenticación entrante.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Autentica al usuario utilizando el método definido en LoginRequest

        $request->session()->regenerate(); // Regenera la sesión para evitar fijación de sesión

        return redirect()->intended(RouteServiceProvider::HOME); // Redirige al usuario a la página de inicio después de iniciar sesión
    }

    /**
     * Destruye una sesión autenticada.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // Cierra la sesión del usuario actual

        $request->session()->invalidate(); // Invalida la sesión actual para que no se pueda reutilizar

        $request->session()->regenerateToken(); // Regenera el token CSRF para la seguridad

        return redirect('/'); // Redirige al usuario a la página de inicio
    }
}

<?php 

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Si no se especifican guardias, usar un array con valor null
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Si el usuario está autenticado, redirigir a la ruta definida en RouteServiceProvider::HOME
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Si el usuario no está autenticado, continuar con la solicitud
        return $next($request);
    }
}


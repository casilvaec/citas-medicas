<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Medico;



class MedicoMiddleware
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
          return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }
      
      // Obtener el ID del usuario autenticado
        $userId = Auth::user()->id;

        // Verificar si el usuario está registrado como médico
        if (Medico::where('usuarioId', $userId)->exists()) {
            return $next($request); // Permitir el acceso
        }

        // Redirigir a otra ruta si no es médico
        return redirect()->route('home')->with('error', 'Acceso denegado. Solo para médicos.');
    }
}
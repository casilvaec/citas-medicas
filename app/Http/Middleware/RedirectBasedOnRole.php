<?php

// app/Http/Middleware/RedirectBasedOnRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectBasedOnRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        
        // Log para depuración
        Log::info('Usuario autenticado:', ['id' => $user->id, 'estadoId' => $user->estadoId, 'roles' => $user->roles->pluck('id')]);

        // Verifica si el estado del usuario es 1
        if ($user->estadoId == 1) {
            // Redirige al usuario a completar su perfil
            Log::info('Redirigiendo a completar perfil.');
            return redirect()->route('profile.edit');
        }

        // Verifica si el estado del usuario es 2
        if ($user->estadoId == 2) {
            // Obtener los IDs de los roles
            $adminRoleId = 7;
            $patientRoleId = 1;
            // Otros roles pueden ser añadidos aquí si es necesario

            // Redirigir basado en el rol del usuario
            if ($user->roles->contains($adminRoleId)) {
                Log::info('Redirigiendo a dashboard de administrador.');
                return redirect()->route('admin.dashboard');
            }

            if ($user->roles->contains($patientRoleId)) {
                Log::info('Redirigiendo a dashboard de paciente.');
                return redirect()->route('patient.dashboard');
            }

            // Agregar lógica para otros roles si es necesario
            // Ejemplo:
            // if ($user->roles->contains($doctorRoleId)) {
            //     Log::info('Redirigiendo a dashboard de doctor.');
            //     return redirect()->route('doctor.dashboard');
            // }
        }

        // Permitir que la solicitud continúe si no se cumple ninguna condición
        Log::info('Continuando con la solicitud.');
        return $next($request);
    }
}

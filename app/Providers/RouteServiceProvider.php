<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * El camino a la ruta "home" para tu aplicación.
     *
     * Esto se usa por la autenticación de Laravel para redirigir a los usuarios después de iniciar sesión.
     *
     * @var string
     */
    public const HOME = '/profile/edit'; // Redirigir a la página de edición del perfil

    /**
     * Define tus enlaces de modelo de ruta, filtros de patrón, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // Configuración de rutas para la API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Configuración de rutas para la web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configura los limitadores de velocidad para la aplicación.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            // Limitar las solicitudes a 60 por minuto
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}

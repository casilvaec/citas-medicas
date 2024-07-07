<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     * 
     * Estos middleware se ejecutan durante cada solicitud a la aplicación.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     * 
     * Estos middleware se asignan a grupos de rutas, como 'web' y 'api'.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class, // Middleware para encriptar cookies
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Middleware para agregar cookies a la respuesta
            \Illuminate\Session\Middleware\StartSession::class, // Middleware para iniciar sesión
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Middleware para compartir errores de la sesión con las vistas
            \App\Http\Middleware\VerifyCsrfToken::class, // Middleware para verificar el token CSRF
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Middleware para sustituir enlaces de ruta
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api', // Middleware para limitar la tasa de solicitudes a la API
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Middleware para sustituir enlaces de ruta
        ],
    ];

    /**
     * The application's route middleware.
     * 
     * Estos middleware pueden asignarse a grupos o usarse individualmente.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Middleware para autenticar usuarios
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // Middleware para autenticar con autenticación básica
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class, // Middleware para autenticar sesión
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, // Middleware para establecer encabezados de caché
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // Middleware para autorizar acciones
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Middleware para redirigir si está autenticado
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // Middleware para requerir confirmación de contraseña
        'signed' => \App\Http\Middleware\ValidateSignature::class, // Middleware para validar firmas de URL
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Middleware para limitar la tasa de solicitudes
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // Middleware para asegurar que el email esté verificado
    ];
}

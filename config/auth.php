<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el guard de autenticación por defecto y las opciones
    | de restablecimiento de contraseña para tu aplicación. Puedes cambiar estos
    | valores según sea necesario, pero son un buen comienzo para la mayoría de
    | las aplicaciones.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | A continuación, puedes definir cada guard de autenticación para tu aplicación.
    | Por supuesto, una gran configuración predeterminada ha sido definida para ti
    | aquí, que utiliza el almacenamiento de sesiones y el proveedor de usuarios
    | Eloquent.
    |
    | Todos los drivers de autenticación tienen un proveedor de usuarios. Esto define
    | cómo se recuperan los usuarios de tu base de datos o de otros mecanismos de
    | almacenamiento que usa esta aplicación para persistir los datos de tus usuarios.
    |
    | Soportados: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Todos los drivers de autenticación tienen un proveedor de usuarios. Esto define
    | cómo se recuperan los usuarios de tu base de datos u otros mecanismos de
    | almacenamiento usados por esta aplicación para persistir los datos de los usuarios.
    |
    | Si tienes múltiples tablas o modelos de usuario, puedes configurar múltiples
    | fuentes que representen cada modelo/tabla. Estas fuentes pueden ser asignadas
    | a cualquier guard de autenticación adicional que hayas definido.
    |
    | Soportados: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Puedes especificar múltiples configuraciones de restablecimiento de contraseña
    | si tienes más de una tabla o modelo de usuario en la aplicación y deseas tener
    | configuraciones separadas de restablecimiento de contraseña basadas en los tipos
    | específicos de usuario.
    |
    | El tiempo de expiración es el número de minutos que cada token de restablecimiento
    | será considerado válido. Esta característica de seguridad mantiene los tokens de
    | corta duración para que tengan menos tiempo de ser adivinados. Puedes cambiar esto
    | según sea necesario.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Aquí puedes definir la cantidad de segundos antes de que una confirmación de
    | contraseña expire y el usuario sea solicitado a reingresar su contraseña a través
    | de la pantalla de confirmación. Por defecto, el tiempo de espera es de tres horas.
    |
    */

    'password_timeout' => 10800,

];

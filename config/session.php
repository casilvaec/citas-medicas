<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Controlador de Sesión Predeterminado
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el controlador de sesión "driver" predeterminado que 
    | se utilizará en las solicitudes. De forma predeterminada, se utilizará 
    | el controlador nativo ligero, pero puede especificar cualquiera de los 
    | otros controladores proporcionados aquí.
    |
    | Soportado: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Duración de la Sesión
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar el número de minutos que desea que la sesión 
    | permanezca inactiva antes de que expire. Si desea que expiren 
    | inmediatamente al cerrar el navegador, configure esa opción.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120),

    // Determina si la sesión debe expirar al cerrar el navegador
    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Encriptación de la Sesión
    |--------------------------------------------------------------------------
    |
    | Esta opción le permite especificar fácilmente que todos los datos de la 
    | sesión deben encriptarse antes de ser almacenados. Toda la encriptación 
    | se ejecutará automáticamente por Laravel y puede usar la Sesión como de 
    | costumbre.
    |
    */

    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | Ubicación de Archivos de Sesión
    |--------------------------------------------------------------------------
    |
    | Cuando se utiliza el controlador de sesión nativo, necesitamos una 
    | ubicación donde se puedan almacenar los archivos de sesión. Se ha 
    | configurado una predeterminada, pero puede especificar una ubicación 
    | diferente si es necesario. Esto solo es necesario para sesiones de archivo.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Conexión de Base de Datos de Sesión
    |--------------------------------------------------------------------------
    |
    | Al usar los controladores de sesión "database" o "redis", puede 
    | especificar una conexión que se debe usar para gestionar estas sesiones. 
    | Esto debe corresponder a una conexión en sus opciones de configuración 
    | de la base de datos.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabla de Base de Datos de Sesión
    |--------------------------------------------------------------------------
    |
    | Al usar el controlador de sesión "database", puede especificar la tabla 
    | que deberíamos usar para gestionar las sesiones. Por supuesto, se 
    | proporciona un valor predeterminado sensato, pero puede cambiar esto si 
    | es necesario.
    |
    */

    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | Almacén de Caché de Sesión
    |--------------------------------------------------------------------------
    |
    | Al usar uno de los backends de sesión impulsados por caché del framework, 
    | puede enumerar un almacén de caché que debe usarse para estas sesiones. 
    | Este valor debe coincidir con uno de los "almacenes" de caché configurados 
    | en la aplicación.
    |
    | Afecta a: "apc", "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Lotería de Barrido de Sesión
    |--------------------------------------------------------------------------
    |
    | Algunos controladores de sesión deben barrer manualmente su ubicación de 
    | almacenamiento para deshacerse de las sesiones antiguas. Aquí están las 
    | probabilidades de que esto suceda en una solicitud dada. Por defecto, las 
    | probabilidades son 2 de 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nombre de la Cookie de Sesión
    |--------------------------------------------------------------------------
    |
    | Aquí puede cambiar el nombre de la cookie utilizada para identificar una 
    | instancia de sesión por ID. El nombre especificado aquí se utilizará 
    | cada vez que se cree una nueva cookie de sesión por el framework para 
    | cada controlador.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Ruta de la Cookie de Sesión
    |--------------------------------------------------------------------------
    |
    | La ruta de la cookie de sesión determina la ruta para la cual la cookie 
    | se considerará disponible. Normalmente, esta será la ruta raíz de su 
    | aplicación, pero puede cambiar esto si es necesario.
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Dominio de la Cookie de Sesión
    |--------------------------------------------------------------------------
    |
    | Aquí puede cambiar el dominio de la cookie utilizada para identificar 
    | una sesión en su aplicación. Esto determinará qué dominios tienen acceso 
    | a la cookie en su aplicación. Se ha establecido un valor predeterminado 
    | sensato.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Cookies Solo HTTPS
    |--------------------------------------------------------------------------
    |
    | Al configurar esta opción como verdadera, las cookies de sesión solo se 
    | enviarán al servidor si el navegador tiene una conexión HTTPS. Esto 
    | evitará que la cookie se envíe cuando no se pueda hacer de manera segura.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | Solo Acceso HTTP
    |--------------------------------------------------------------------------
    |
    | Configurar este valor como verdadero evitará que JavaScript acceda al 
    | valor de la cookie y la cookie solo será accesible a través del protocolo 
    | HTTP. Puede modificar esta opción si es necesario.
    |
    */

    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Cookies Same-Site
    |--------------------------------------------------------------------------
    |
    | Esta opción determina cómo se comportan sus cookies cuando se realizan 
    | solicitudes entre sitios y se puede utilizar para mitigar ataques CSRF. 
    | Por defecto, configuraremos este valor como "lax" ya que este es un valor 
    | predeterminado seguro.
    |
    | Soportado: "lax", "strict", "none", null
    |
    */

    'same_site' => 'lax',

];

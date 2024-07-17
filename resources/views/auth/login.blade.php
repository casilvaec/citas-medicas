<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Incluye los estilos CSS de la aplicación -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    {{-- @vite('resources/css/app.css') --}}

    <!-- Incluye los estilos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Incluye los estilos CSS personalizados de la aplicación -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="{{ asset('hospital-logo.png') }}" alt="Hospital Logo" class="img-fluid" style="width: 100px;">
                    </div>
                    <div class="card-body">
                        <h3 class="text-center mb-4">Hospital Isidro Ayora</h3>

                        <!-- Muestra errores de validación si los hay -->
                        <x-validation-errors class="mb-4" />

                        <!-- Muestra un mensaje de estado si hay alguno en la sesión -->
                        {{-- Proporciona una forma efectiva de informar al usuario sobre el resultado de sus acciones (éxito, error, advertencia, etc.). --}}
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Formulario de inicio de sesión -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf <!-- Token CSRF para protección contra ataques CSRF -->

                            <!-- Campo de entrada para el nombre de usuario -->
                            <div class="form-group">
                                <label for="username">Usuario</label>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                <!-- 
                                    Beneficio: 
                                    - `old('username')` mantiene el valor anterior si hay errores de validación, 
                                    lo cual mejora la experiencia del usuario al no tener que reingresar datos.
                                    - `required` asegura que el campo no se envíe vacío.
                                    - `autofocus` pone automáticamente el cursor en este campo cuando la página carga.
                                -->
                            </div>

                            <!-- Campo de entrada para la contraseña -->
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            <!-- Checkbox para recordar sesión -->
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Acuérdate de mí</label>
                                <!-- 
                                    Beneficio: 
                                    - Permite al usuario mantener su sesión iniciada en el navegador.
                                -->
                            </div>

                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary btn-block">
                                Acceso
                            </button>

                            <!-- Enlace para recuperar contraseña -->
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye los scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

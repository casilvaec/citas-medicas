<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Enlazamos Bootstrap para estilos -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos para centrar el formulario de registro en la pantalla */
        body {
            background-color: #e9f7f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .register-container img {
            display: block;
            margin: 0 auto 20px;
        }
        .register-container .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<!-- Contenedor del formulario de registro -->
<div class="register-container">
    <!-- Formulario para registrarse -->
    <form method="POST" action="{{ route('register') }}">
        <!-- Token CSRF para proteger contra ataques CSRF -->
        @csrf
        <!-- Logo y título del formulario -->
        <div class="text-center">
            <img src="hospital-logo.png" alt="Hospital Logo" width="72" height="72">
            <h2>Hospital Isidro Ayora</h2>
            <p>Por favor, ingresa tus datos para registrarte.</p>
        </div>

        <!-- Campo para ingresar el nombre -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Ingresa tu nombre" value="{{ old('nombre') }}" required autofocus>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo para los apellidos -->
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" placeholder="Ingresa tus apellidos" value="{{ old('apellidos') }}" required>
            @error('apellidos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo para ingresar el correo electrónico -->
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror" id="correoElectronico" placeholder="Ingresa tu correo electrónico" value="{{ old('correoElectronico') }}" required>
            @error('correoElectronico')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo para ingresar la contraseña -->
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Contraseña" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo para confirmar la contraseña -->
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar Contraseña" required>
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
        <!-- Enlace para iniciar sesión si ya tiene una cuenta -->
        <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    </form>
</div>

<!-- Enlazamos scripts de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

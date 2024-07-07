<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Enlazamos Bootstrap para estilos -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9f7f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container img {
            display: block;
            margin: 0 auto 20px;
        }
        .login-container .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<!-- Contenedor del formulario de inicio de sesión -->
<div class="login-container">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-center">
            <img src="hospital-logo.png" alt="Hospital Logo" width="72" height="72">
            <h2>Hospital Isidro Ayora</h2>
            <p>Por favor, ingresa tus datos para iniciar sesión.</p>
        </div>

        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror" id="correoElectronico" placeholder="Ingresa tu correo electrónico" value="{{ old('correoElectronico') }}" required autofocus>
            @error('correoElectronico')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Contraseña" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Recuérdame</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        @endif

        <p class="text-center mt-3">¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
    </form>
</div>

<!-- Enlazamos scripts de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

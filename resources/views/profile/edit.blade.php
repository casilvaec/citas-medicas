{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Editar Perfil</h1>

        @if (session('status') == 'profile-updated')
            <div class="alert alert-success">
                Perfil actualizado con éxito. Por favor, inicie sesión nuevamente.
                <br>
                <strong>Usuario:</strong> {{ $user->username }}<br>
                <strong>Contraseña:</strong> (Solo para pruebas: {{ session('password') }})
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- Tipo de Identificación -->
            <div class="form-group">
                <label for="tipoIdentificacionId">Tipo de Identificación</label>
                <select name="tipoIdentificacionId" class="form-control @error('tipoIdentificacionId') is-invalid @enderror" id="tipoIdentificacionId" required>
                    @foreach($tiposIdentificacion as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipoIdentificacionId', $user->tipoIdentificacionId) == $tipo->id ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                    @endforeach
                </select>
                @error('tipoIdentificacionId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Número de Identificación -->
            <div class="form-group">
                <label for="identificacion">Número de Identificación</label>
                <input type="text" name="identificacion" class="form-control @error('identificacion') is-invalid @enderror" id="identificacion" value="{{ old('identificacion', $user->identificacion) }}" required>
                @error('identificacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Género -->
            <div class="form-group">
                <label for="generoId">Género</label>
                <select name="generoId" class="form-control @error('generoId') is-invalid @enderror" id="generoId" required>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}" {{ old('generoId', $user->generoId) == $genero->id ? 'selected' : '' }}>{{ $genero->nombre }}</option>
                    @endforeach
                </select>
                @error('generoId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Ciudad de Residencia -->
            <div class="form-group">
                <label for="ciudadResidenciaId">Ciudad de Residencia</label>
                <select name="ciudadResidenciaId" class="form-control @error('ciudadResidenciaId') is-invalid @enderror" id="ciudadResidenciaId" required>
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" {{ old('ciudadResidenciaId', $user->ciudadResidenciaId) == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
                @error('ciudadResidenciaId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" value="{{ old('nombre', $user->nombre) }}" required>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Apellidos -->
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" value="{{ old('apellidos', $user->apellidos) }}" required>
                @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Correo Electrónico -->
            <div class="form-group">
                <label for="correoElectronico">Correo Electrónico</label>
                <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror" id="correoElectronico" value="{{ old('correoElectronico', $user->correoElectronico) }}" required>
                @error('correoElectronico')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nombre de Usuario -->
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Teléfono Convencional -->
            <div class="form-group">
                <label for="telefonoConvencional">Teléfono Convencional</label>
                <input type="text" name="telefonoConvencional" class="form-control @error('telefonoConvencional') is-invalid @enderror" id="telefonoConvencional" value="{{ old('telefonoConvencional', $user->telefonoConvencional) }}">
                @error('telefonoConvencional')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Teléfono Celular -->
            <div class="form-group">
                <label for="telefonoCelular">Teléfono Celular</label>
                <input type="text" name="telefonoCelular" class="form-control @error('telefonoCelular') is-invalid @enderror" id="telefonoCelular" value="{{ old('telefonoCelular', $user->telefonoCelular) }}">
                @error('telefonoCelular')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Dirección -->
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" id="direccion" value="{{ old('direccion', $user->direccion) }}">
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fechaNacimiento" class="form-control @error('fechaNacimiento') is-invalid @enderror" id="fechaNacimiento" value="{{ old('fechaNacimiento', $user->fechaNacimiento) }}">
                @error('fechaNacimiento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Contraseña Actual -->
            <div class="form-group">
                <label for="current_password">Contraseña Actual</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password">
                @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nueva Contraseña -->
            <div class="form-group">
                <label for="password">Nueva Contraseña</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirmar Nueva Contraseña -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>

            <!-- Botón para actualizar el perfil -->
            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a href="{{ route('logout') }}" class="btn btn-secondary logout" 
                onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();">
                Cancelar
            </a>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}}




{{-- segundo codigo  --}}

{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Editar Perfil</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {!! nl2br(e(session('status'))) !!}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- Tipo de Identificación -->
            <div class="form-group">
                <label for="tipoIdentificacionId">Tipo de Identificación</label>
                <select name="tipoIdentificacionId" class="form-control @error('tipoIdentificacionId') is-invalid @enderror" id="tipoIdentificacionId" required>
                    @foreach($tiposIdentificacion as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipoIdentificacionId', $user->tipoIdentificacionId) == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('tipoIdentificacionId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Número de Identificación -->
            <div class="form-group">
                <label for="numeroIdentificacion">Número de Identificación</label>
                <input type="text" name="numeroIdentificacion" class="form-control @error('numeroIdentificacion') is-invalid @enderror" id="numeroIdentificacion" value="{{ old('numeroIdentificacion', $user->numeroIdentificacion) }}" required>
                @error('numeroIdentificacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Género -->
            <div class="form-group">
                <label for="generoId">Género</label>
                <select name="generoId" class="form-control @error('generoId') is-invalid @enderror" id="generoId" required>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}" {{ old('generoId', $user->generoId) == $genero->id ? 'selected' : '' }}>
                            {{ $genero->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('generoId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Ciudad de Residencia -->
            <div class="form-group">
                <label for="ciudadResidenciaId">Ciudad de Residencia</label>
                <select name="ciudadResidenciaId" class="form-control @error('ciudadResidenciaId') is-invalid @enderror" id="ciudadResidenciaId" required>
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" {{ old('ciudadResidenciaId', $user->ciudadResidenciaId) == $ciudad->id ? 'selected' : '' }}>
                            {{ $ciudad->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('ciudadResidenciaId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" value="{{ old('nombre', $user->nombre) }}" required>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Apellidos -->
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" value="{{ old('apellidos', $user->apellidos) }}" required>
                @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Correo Electrónico -->
            <div class="form-group">
                <label for="correoElectronico">Correo Electrónico</label>
                <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror" id="correoElectronico" value="{{ old('correoElectronico', $user->correoElectronico) }}" required>
                @error('correoElectronico')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nombre de Usuario -->
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Teléfono Convencional -->
            <div class="form-group">
                <label for="telefonoConvencional">Teléfono Convencional</label>
                <input type="text" name="telefonoConvencional" class="form-control @error('telefonoConvencional') is-invalid @enderror" id="telefonoConvencional" value="{{ old('telefonoConvencional', $user->telefonoConvencional) }}">
                @error('telefonoConvencional')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Teléfono Celular -->
            <div class="form-group">
                <label for="telefonoCelular">Teléfono Celular</label>
                <input type="text" name="telefonoCelular" class="form-control @error('telefonoCelular') is-invalid @enderror" id="telefonoCelular" value="{{ old('telefonoCelular', $user->telefonoCelular) }}">
                @error('telefonoCelular')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Dirección -->
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" id="direccion" value="{{ old('direccion', $user->direccion) }}">
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fechaNacimiento" class="form-control @error('fechaNacimiento') is-invalid @enderror" id="fechaNacimiento" value="{{ old('fechaNacimiento', $user->fechaNacimiento) }}">
                @error('fechaNacimiento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Contraseña Actual -->
            <div class="form-group">
                <input type="checkbox" id="change-password" name="change_password">
                <label for="change-password">Marcar si deseas cambiar la contraseña</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" placeholder="Contraseña Actual">
                @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nueva Contraseña -->
            <div class="form-group" id="new-password-fields">
                <label for="password">Nueva Contraseña</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirmar Nueva Contraseña -->
            <div class="form-group" id="confirm-password-fields">
                <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>

            <!-- Botón para actualizar el perfil -->
            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a href="{{ route('logout') }}" class="btn btn-secondary logout" 
                onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();">
                Cancelar
            </a>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const changePasswordCheckbox = document.getElementById('change-password');
            const currentPasswordField = document.getElementById('current_password');
            const newPasswordFields = document.getElementById('new-password-fields');
            const confirmPasswordFields = document.getElementById('confirm-password-fields');

            newPasswordFields.style.display = 'none';
            confirmPasswordFields.style.display = 'none';
            currentPasswordField.style.display = 'none';

            changePasswordCheckbox.addEventListener('change', function () {
                if (changePasswordCheckbox.checked) {
                    currentPasswordField.style.display = 'block';
                } else {
                    currentPasswordField.style.display = 'none';
                    newPasswordFields.style.display = 'none';
                    confirmPasswordFields.style.display = 'none';
                }
            });

            currentPasswordField.addEventListener('input', function () {
                if (currentPasswordField.value.length > 0) {
                    newPasswordFields.style.display = 'block';
                    confirmPasswordFields.style.display = 'block';
                } else {
                    newPasswordFields.style.display = 'none';
                    confirmPasswordFields.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Editar Perfil</h1>

        @if (session('status') == 'profile-updated')
            <div class="alert alert-success">
                Perfil actualizado con éxito. Por favor, inicie sesión nuevamente.
                <br>
                @if (session('password'))
                    <strong>Usuario:</strong> {{ session('username') }}<br>
                    <strong>Contraseña:</strong> (Solo para pruebas: {{ session('password') }})
                @endif
                <a href="{{ route('login') }}" class="btn btn-primary mt-3">Iniciar Sesión</a>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" id="profile-form">
            @csrf
            @method('PATCH')

            <!-- Tipo de Identificación -->
            <div class="form-group">
                <label for="tipoIdentificacionId">Tipo de Identificación</label>
                <select name="tipoIdentificacionId" class="form-control @error('tipoIdentificacionId') is-invalid @enderror" id="tipoIdentificacionId" required>
                    @foreach($tiposIdentificacion as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipoIdentificacionId', $user->tipoIdentificacionId) == $tipo->id ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                    @endforeach
                </select>
                @error('tipoIdentificacionId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Número de Identificación -->
            <div class="form-group">
                <label for="numeroIdentificacion">Número de Identificación</label>
                <input type="text" name="numeroIdentificacion" class="form-control @error('numeroIdentificacion') is-invalid @enderror" id="numeroIdentificacion" value="{{ old('numeroIdentificacion', $user->numeroIdentificacion) }}" required>
                @error('numeroIdentificacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Género -->
            <div class="form-group">
                <label for="generoId">Género</label>
                <select name="generoId" class="form-control @error('generoId') is-invalid @enderror" id="generoId" required>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}" {{ old('generoId', $user->generoId) == $genero->id ? 'selected' : '' }}>{{ $genero->nombre }}</option>
                    @endforeach
                </select>
                @error('generoId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Ciudad de Residencia -->
            <div class="form-group">
                <label for="ciudadResidenciaId">Ciudad de Residencia</label>
                <select name="ciudadResidenciaId" class="form-control @error('ciudadResidenciaId') is-invalid @enderror" id="ciudadResidenciaId" required>
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" {{ old('ciudadResidenciaId', $user->ciudadResidenciaId) == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
                @error('ciudadResidenciaId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" value="{{ old('nombre', $user->nombre) }}" required>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Apellidos -->
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" value="{{ old('apellidos', $user->apellidos) }}" required>
                @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Correo Electrónico -->
            <div class="form-group">
                <label for="correoElectronico">Correo Electrónico</label>
                <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror" id="correoElectronico" value="{{ old('correoElectronico', $user->correoElectronico) }}" required>
                @error('correoElectronico')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Teléfono Convencional -->
            <div class="form-group">
                <label for="telefonoConvencional">Teléfono Convencional</label>
                <input type="text" name="telefonoConvencional" class="form-control @error('telefonoConvencional') is-invalid @enderror" id="telefonoConvencional" value="{{ old('telefonoConvencional', $user->telefonoConvencional) }}">
                @error('telefonoConvencional')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Teléfono Celular -->
            <div class="form-group">
                <label for="telefonoCelular">Teléfono Celular</label>
                <input type="text" name="telefonoCelular" class="form-control @error('telefonoCelular') is-invalid @enderror" id="telefonoCelular" value="{{ old('telefonoCelular', $user->telefonoCelular) }}">
                @error('telefonoCelular')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Dirección -->
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" id="direccion" value="{{ old('direccion', $user->direccion) }}">
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fechaNacimiento" class="form-control @error('fechaNacimiento') is-invalid @enderror" id="fechaNacimiento" value="{{ old('fechaNacimiento', $user->fechaNacimiento) }}">
                @error('fechaNacimiento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Checkbox para cambiar la contraseña -->
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="changePasswordCheck">
                <label class="form-check-label" for="changePasswordCheck">Cambiar Contraseña</label>
            </div>

            <!-- Campos de contraseña -->
            <div id="passwordFields" style="display: none;">
                <div class="form-group">
                    <label for="current_password">Contraseña Actual</label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password">
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
            </div>

            <!-- Botón para actualizar el perfil -->
            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a href="{{ route('logout') }}" class="btn btn-secondary logout" 
                onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();">
                Cancelar
            </a>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileForm = document.getElementById('profile-form');
            const changePasswordCheck = document.getElementById('changePasswordCheck');
            const passwordFields = document.getElementById('passwordFields');
            const currentPassword = document.getElementById('current_password');
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            changePasswordCheck.addEventListener('change', function () {
                if (this.checked) {
                    passwordFields.style.display = 'block';
                    currentPassword.setAttribute('required', 'required');
                    password.setAttribute('required', 'required');
                    passwordConfirmation.setAttribute('required', 'required');
                } else {
                    passwordFields.style.display = 'none';
                    currentPassword.removeAttribute('required');
                    password.removeAttribute('required');
                    passwordConfirmation.removeAttribute('required');
                }
            });

            profileForm.addEventListener('input', function (event) {
                validateField(event.target);
            });

            function validateField(field) {
                if (field.name === 'numeroIdentificacion' && isNaN(field.value)) {
                    setError(field, 'El número de identificación debe ser un número.');
                } else {
                    clearError(field);
                }

                if (field.name === 'telefonoConvencional' && !/^[0-9]+$/.test(field.value)) {
                    setError(field, 'Debe ingresar solo números.');
                } else {
                    clearError(field);
                }

                if (field.name === 'telefonoCelular' && !/^[0-9]+$/.test(field.value)) {
                    setError(field, 'Debe ingresar solo números.');
                } else {
                    clearError(field);
                }

                if (field.name === 'correoElectronico' && !/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,6}$/.test(field.value)) {
                    setError(field, 'Debe ingresar un correo electrónico válido.');
                } else {
                    clearError(field);
                }

                if (field.name === 'current_password' && password.value && !field.value) {
                    setError(field, 'Debe ingresar su contraseña actual para cambiar la contraseña.');
                } else {
                    clearError(field);
                }

                if (field.name === 'password' && field.value !== passwordConfirmation.value) {
                    setError(field, 'Las contraseñas no coinciden.');
                } else {
                    clearError(field);
                }

                if (field.name === 'password_confirmation' && field.value !== password.value) {
                    setError(field, 'Las contraseñas no coinciden.');
                } else {
                    clearError(field);
                }
            }

            function setError(field, message) {
                field.classList.add('is-invalid');
                let error = field.nextElementSibling;
                if (!error || !error.classList.contains('invalid-feedback')) {
                    error = document.createElement('span');
                    error.classList.add('invalid-feedback');
                    field.after(error);
                }
                error.innerHTML = '<strong>' + message + '</strong>';
            }

            function clearError(field) {
                field.classList.remove('is-invalid');
                let error = field.nextElementSibling;
                if (error && error.classList.contains('invalid-feedback')) {
                    error.remove();
                }
            }
        });
    </script>
</body>
</html>



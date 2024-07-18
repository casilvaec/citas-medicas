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
                Perfil actualizado con éxito.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- Tipo de Identificación -->
            <div class="form-group">
                <label for="tipoIdentificacionId">Tipo de Identificación</label>
                <select name="tipoIdentificacionId" class="form-control @error('tipoIdentificacionId') is-invalid @enderror" id="tipoIdentificacionId" required>
                    @foreach ($tiposIdentificacion as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipoIdentificacionId', $user->tipoIdentificacionId) == $tipo->id ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                    @endforeach
                </select>
                @error('tipoIdentificacionId')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Identificación -->
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
                    @foreach ($generos as $genero)
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
                    @foreach ($ciudades as $ciudad)
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

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
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
</html>







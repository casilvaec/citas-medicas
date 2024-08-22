@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agendar Cita Médica</h1>

    <!-- Formulario de Búsqueda de Paciente -->
    <form action="{{ route('admin.citas.buscarPaciente') }}" method="POST">
      @csrf
      <div class="form-group">
          <label for="busquedaPaciente">Buscar Usuario:</label>
          <div class="input-group">
              <input type="text" name="busquedaPaciente" id="busquedaPaciente" class="form-control" placeholder="Ingrese Identificación (Cédula, Pasaporte, RUC)" required>
              <div class="input-group-append">
                  <button type="submit" class="btn btn-primary">Buscar</button>
                  <a href="{{ route('admin.pacientes.create') }}" class="btn btn-success ml-2">Registrar Nuevo Paciente</a>
              </div>
          </div>
      </div>
  </form>
    {{-- <form action="{{ route('admin.citas.buscarPaciente') }}" method="POST" id="buscar-paciente-form">
        @csrf
        <div class="form-group">
            <label for="busquedaPaciente">Buscar Paciente:</label>
            <input type="text" name="busquedaPaciente" id="busquedaPaciente" class="form-control" placeholder="Ingrese identificación">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <hr> --}}

     <!-- Mostrar mensaje de error solo si hay un error en la sesión -->
    @if(session('error'))
     <p class="text-danger">{{ session('error') }}</p>
    @endif

    <!-- Mostrar Datos del Usuario (si existe) -->
    @if(isset($usuario))
        <div id="datos-usuario" class="mt-4">
            <h3>Datos del Usuario</h3>
            <p><strong>Nombre:</strong> {{ $usuario->nombre }} {{ $usuario->apellidos }}</p>
            <p><strong>Número de Identificación:</strong> {{ $usuario->numeroIdentificacion }}</p>

            <!-- Botón para seleccionar especialidad médica -->
            <button id="btn-seleccionar-especialidad" class="btn btn-primary mt-3">
              Seleccionar Especialidad
          </button>

          <!-- Contenedor donde se mostrará el selector de especialidades -->
          <div id="especialidad-container" style="display: none;" class="mt-3">
              <h3>Seleccionar Especialidad</h3>
              <form id="form-seleccionar-especialidad" method="POST" action="{{ route('admin.citas.medicos') }}">
                  @csrf
                  <div class="form-group">
                      <label for="especialidad_id">Especialidad Médica:</label>
                      <select name="especialidad_id" id="especialidad_id" class="form-control" required>
                          <option value="">Seleccione una especialidad</option>
                      </select>
                  </div>
                  <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                  <button type="submit" class="btn btn-success">Confirmar Especialidad</button>
              </form>
          </div>
      </div>
 
  @endif
</div>
            <!-- Guardar el ID del usuario en una variable JavaScript -->
            {{-- <script>
              var usuarioId = "{{ $usuario->id }}"; // * Asigna el ID del usuario a una variable JS
            </script> --}}

            <!-- Botón para continuar con la selección de especialidad -->
            {{-- <form action="{{ route('admin.citas.especialidad') }}" method="GET" id="form-seleccionar-especialidad">
                @csrf
                <div class="form-group">
                  <label for="especialidad_id">Especialidad Médica:</label>
                  <select name="especialidad_id" id="especialidad_id" class="form-control" required>
                      <option value="">Seleccione una especialidad</option>
                      @foreach($especialidades as $id => $nombre)
                          <option value="{{ $id }}">{{ $nombre }}</option>
                      @endforeach
                  </select>
                </div>
                <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                <button type="submit" class="btn btn-primary">Seleccionar Especialidad</button>
            </form> --}}

            

            <!-- Formulario para seleccionar una especialidad médica -->
            {{-- <div id="seleccionar-especialidad"> --}}
              {{-- <h3>Seleccionar Especialidad</h3>
              <form action="{{ route('admin.citas.medicos') }}" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="especialidad_id">Especialidad Médica:</label>
                      <select name="especialidad_id" id="especialidad_id" class="form-control" required>
                          <option value="">Seleccione una especialidad</option>
                          @foreach($especialidades as $id => $nombre)
                              <option value="{{ $id }}">{{ $nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                  <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                  <button type="submit" class="btn btn-primary">Seleccionar Médico</button>
              </form> --}}
          {{-- </div>  --}}
        </div>
    

    <!-- Contenedor vacío para cargar dinámicamente el siguiente paso -->
    {{-- <div id="contenidoDinamico" class="mt-4"></div>

    </div> --}}

    <!-- Script para manejar la selección en la misma página -->
{{-- <script> --}}
  {{-- // Escucha el evento click en el botón para seleccionar la especialidad
  document.getElementById('seleccionar-especialidad-btn').addEventListener('click', function() {
      var especialidadId = document.getElementById('especialidad_id').value;

      // Verifica que se haya seleccionado una especialidad
      if (especialidadId) {
          // Muestra el siguiente formulario dentro del contenedor dinámico
          var contenidoDinamico = document.getElementById('contenidoDinamico');
          contenidoDinamico.innerHTML = `
              <h3>Continuar con la Selección</h3>
              <form action="{{ route('admin.citas.confirmacion') }}" method="POST">
                  @csrf
                  <!-- Enviar especialidad seleccionada -->
                  <input type="hidden" name="especialidad_id" value="${especialidadId}">
                  <!-- Usar la variable JS 'usuarioId' en lugar de $usuario->id -->
                  <input type="hidden" name="usuario_id" value="${usuarioId}">
                  <button type="submit" class="btn btn-primary">Continuar</button>
              </form>
          `;
      } else {
          alert('Por favor, seleccione una especialidad.');
      }
  });
</script> --}}
{{-- @endsection --}}

    <!-- Mostrar Selección de Especialidad (si ya se seleccionó el paciente) -->
    {{-- @if(isset($especialidades))
        <div id="seleccionar-especialidad" class="mt-4">
            <h3>Seleccionar Especialidad</h3>
            <form action="{{ route('admin.citas.confirmacion') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="especialidad_id">Especialidad Médica:</label>
                    <select name="especialidad_id" id="especialidad_id" class="form-control" required>
                        <option value="">Seleccione una especialidad</option>
                        @foreach($especialidades as $id => $nombre)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                <button type="submit" class="btn btn-primary">Continuar</button>
            </form>
        </div>
    @endif --}}

    <!-- Mostrar Disponibilidad de Médicos (si ya se seleccionó la especialidad) -->
    {{-- @if(isset($medicos))
        <div id="seleccionar-medico-horario" class="mt-4">
            <h3>Seleccionar Médico y Horario</h3>
            <form action="{{ route('admin.citas.agendar') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="medico_id">Médico:</label>
                    <select name="medico_id" id="medico_id" class="form-control" required>
                        <option value="">Seleccione un médico</option>
                        @foreach($medicos as $id => $nombre)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="horario">Horario Disponible:</label>
                    <select name="horario" id="horario" class="form-control" required>
                        <option value="">Seleccione un horario</option>
                        @foreach($horarios as $horario)
                            <option value="{{ $horario }}">{{ $horario }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                <input type="hidden" name="especialidad_id" value="{{ $especialidad->id }}">
                <button type="submit" class="btn btn-primary">Agendar Cita</button>
            </form>
        </div>
    @endif --}}
    
    

    <!-- Botón para registrar un nuevo paciente -->
    {{-- <div id="registrar-paciente" class="mt-4">
        <a href="{{ route('admin.pacientes.create') }}" class="btn btn-success">Registrar Nuevo Paciente</a>
    </div> --}}
</div>
<script>
  document.getElementById('btn-seleccionar-especialidad').addEventListener('click', function() {
      fetch('/admin/citas/obtener-especialidades')
          .then(response => response.json())
          .then(data => {
              const selectEspecialidad = document.getElementById('especialidad_id');
              selectEspecialidad.innerHTML = ''; // Limpiar opciones existentes
              if (Object.keys(data).length > 0) {
                  Object.entries(data).forEach(([id, nombre]) => {
                      const option = document.createElement('option');
                      option.value = id;
                      option.textContent = nombre;
                      selectEspecialidad.appendChild(option);
                  });

                  // Mostrar el contenedor de especialidades
                  document.getElementById('especialidad-container').style.display = 'block';
              } else {
                  alert('No hay especialidades disponibles.');
              }
          })
          .catch(error => {
              console.error('Error al cargar especialidades:', error);
              alert('Ocurrió un error al cargar las especialidades. Intente nuevamente.');
          });
  });
</script>

@endsection

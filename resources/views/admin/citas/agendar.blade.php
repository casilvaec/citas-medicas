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
            
        </div>
    

    
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

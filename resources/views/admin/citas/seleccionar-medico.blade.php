<!-- resources/views/admin/citas/seleccionar-medico.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seleccionar Médico</h1>

    @if($medicos->isEmpty())
        <p>No hay médicos disponibles para esta especialidad.</p>
    @else
        {{-- <form action="{{ route('admin.citas.confirmarCita') }}" method="POST"> --}}
          <form action="{{ route('admin.citas.mostrarCalendario') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="medico_id">Médico:</label>
                <select name="medico_id" id="medico_id" class="form-control" required>
                    @foreach($medicos as $id => $nombre_completo)
                        <option value="{{ $id }}">{{ $nombre_completo }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="usuario_id" value="{{ $usuario_id }}">
            <input type="hidden" name="especialidad_id" value="{{ $especialidad_id }}">
            

            <button type="submit" class="btn btn-primary">Confirmar Médico</button>
        </form>
    @endif

    <!-- Aquí es donde se mostrará el calendario solo si la variable $calendario está definida -->
    @if(isset($calendario) && $calendario)
   
    <div class="mt-4">
        <h2>Seleccionar Fecha para la Cita</h2>

        <!-- Div donde se renderizará el calendario -->
        <div id="calendar"></div>

        <!-- Formulario para seleccionar la fecha y el horario -->
        
        {{-- <form id="form-confirmar-cita" action="{{ route('admin.citas.mostrarCalendario') }}" method="POST"> --}}
        <form id="form-confirmar-cita" action="{{ route('admin.citas.confirmarCita') }}" method="POST">
          @csrf

          <!-- Campos ocultos para almacenar la fecha y el horario seleccionados -->
          <input type="hidden" name="fecha_cita" id="fecha_cita">
          <input type="hidden" name="horario_cita" id="horario_cita">
          {{-- <div class="form-group">
              <label for="fecha_cita">Fecha:</label>
              <input type="date" id="fecha_cita" name="fecha_cita" class="form-control" min="{{ date('Y-m-d') }}" required>
          </div> --}}

          {{-- <div class="form-group">
              <label for="horario_cita">Horario:</label>
              <select name="horario_cita" id="horario_cita" class="form-control" required>
                  <!-- Llenar el dropdown con los horarios disponibles -->
                  @foreach($disponibilidad as $horario)
                      <option value="{{ $horario }}">{{ $horario }}</option>
                  @endforeach
              </select>
          </div> --}}

           <!-- Estos campos aseguran que la información del usuario y el médico se pasen al método confirmarCita -->
          <input type="hidden" name="usuario_id" value="{{ $usuario_id }}">
          <input type="hidden" name="medico_id" value="{{ $medico_id }}"> 
          <input type="hidden" name="usuario_nombre" value="{{ $usuario_nombre }}">
          <input type="hidden" name="usuario_apellidos" value="{{ $usuario_apellidos }}">
          <input type="hidden" name="medico_nombre" value="{{ $medico_nombre }}">
          <input type="hidden" name="medico_apellidos" value="{{ $medico_apellidos }}">
          {{-- <input type="hidden" name="especialidad" value="{{ $especialidad }}">  --}}
        {{-- <input type="date" id="fecha_cita" name="fecha_cita" class="form-control" min="{{ date('Y-m-d') }}" required> --}}
        <button type="submit" class="btn btn-success mt-3">Confirmar Cita</button>
        </form>
      </div>
    @endif
</div>


<!-- Incluir FullCalendar CSS y JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/es.global.min.js"></script> --}}


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
  <!-- FullCalendar CSS -->
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet"> --}}

  <!-- FullCalendar JS -->
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script> --}}


{{-- <script>
  // Script para validar y manejar el formulario de selección de médico
  document.getElementById('confirmar-medico-btn').addEventListener('click', function() {
      document.getElementById('form-seleccionar-medico').submit();
  });

  // Bloqueamos las fechas pasadas en el input de fecha
  var fechaCita = document.getElementById('fecha_cita');
  if(fechaCita) {
      var today = new Date().toISOString().split('T')[0];
      fechaCita.setAttribute('min', today);
  }
</script>
@endsection --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var medico_id = {{ $medico_id }}; // Obtiene el ID del médico seleccionado

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Muestra el calendario en la vista de mes completo
        selectable: true,
        locale: 'es',
        // headerToolbar: {
        //     left: 'prev,next today',
        //     center: 'title',
        //     right: 'dayGridMonth,timeGridWeek,timeGridDay'
        // },
        buttonText: {
            today: 'Hoy', // Cambia "today" a "Hoy"
        },

        events: function(fetchInfo, successCallback, failureCallback) {
                // Consultar la disponibilidad desde el servidor para el médico seleccionado
                fetch(`/admin/disponibilidad/${medico_id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Mapea la disponibilidad obtenida a eventos que FullCalendar puede mostrar
                        var events = data.map(disponibilidad => {
                            return {
                                title: 'Disponible', // Título del evento
                                start: `${disponibilidad.fecha}T${disponibilidad.horaInicio}`, // Hora de inicio
                                end: `${disponibilidad.fecha}T${disponibilidad.horaFin}`, // Hora de fin
                                backgroundColor: '#28a745', // Color de fondo
                                borderColor: '#28a745' // Color del borde
                            };
                        });
                        successCallback(events); // Muestra los eventos en el calendario
                    });
            },

        // dateClick: function(info) {
        //   document.getElementById('fecha_cita').value = info.dateStr;
        //   alert('Fecha seleccionada: ' + info.dateStr);
        // }

        dateClick: function(info) {
                // Maneja el clic en una fecha/hora específica
                var fecha = info.dateStr.split('T')[0]; // Obtiene la fecha seleccionada
                var horaInicio = info.dateStr.split('T')[1]; // Obtiene la hora seleccionada
                
                // Realizar la reserva del horario seleccionado
                fetch('{{ route("admin.disponibilidad.reservar") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añade el token CSRF para seguridad
                    },
                    body: JSON.stringify({
                        medico_id: medico_id, // ID del médico
                        fecha: fecha, // Fecha seleccionada
                        horaInicio: horaInicio // Hora seleccionada
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cita reservada exitosamente'); // Muestra un mensaje de éxito
                        calendar.refetchEvents(); // Refresca el calendario para mostrar los horarios actualizados
                    } else {
                        alert('Error al reservar la cita'); // Muestra un mensaje de error
                    }
                });
            } 

      });
      calendar.render();
    });
  </script>
  

{{-- <script>
  document.addEventListener('DOMContentLoaded', function() {
      // Inicialización de FullCalendar
      var calendarEl = document.getElementById('calendar');

      if (calendarEl) {  // Solo inicializa si el calendario está presente
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Vista inicial del calendario
            selectable: true, // Habilitar la selección de fechas
            dateClick: function(info) {
                // Al hacer clic en una fecha, se almacena en el campo oculto 'fecha_cita'
                document.getElementById('fecha_cita').value = info.dateStr;
                alert('Fecha seleccionada: ' + info.dateStr); // Muestra un mensaje de confirmación (opcional)
            },
            events: [
                // Aquí puedes cargar eventos de disponibilidad
                // Ejemplo:
                // {
                //     title: 'Disponible',
                //     start: '2024-08-25T09:00:00',
                //     end: '2024-08-25T12:00:00'
                // }
            ]
        });

      calendar.render(); // Renderizar el calendario
      } else {
        console.error('El calendario no está presente en la página');
      }
  });
</script> --}}
@endsection

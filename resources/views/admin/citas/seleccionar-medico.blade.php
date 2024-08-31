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
            

            <button type="submit" id="confirmarMedicoBtn" class="btn btn-primary">Confirmar Médico</button>
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
            
            <!-- Cambiar la ruta para pasar el ID del médico -->
            {{-- <form id="form-confirmar-cita" action="{{ route('admin.citas.confirmarCita', ['medicoId' => $medico_id]) }}" method="POST">
                @csrf
                <!-- ... (el resto del código sigue igual) -->
            </form> --}}
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


<script>


    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM cargado');

        var calendarEl = document.getElementById('calendar');
        var calendar; // Variable para almacenar la instancia del calendario
        

        if (!calendarEl) {
            console.error('Elemento de calendario no encontrado');
            return; // Detener ejecución si no hay elemento de calendario
        } else {
            console.log('Elemento de calendario encontrado:', calendarEl);
        }

        

        // * Función para inicializar el calendario
        function inicializarCalendario(medico_id) {
            console.log(`Inicializando calendario para el médico con ID: ${medico_id}`);

            

            // if (!calendarEl) {
            //     console.error('Elemento de calendario no encontrado durante la inicialización');
            //     return;
            // }

            if (calendar) {
                console.log('Destruyendo instancia previa del calendario');
                calendar.destroy(); // Destruye la instancia del calendario actual para evitar duplicados
            }

            console.log(`Inicializando calendario para el médico con ID: ${medico_id}`);

            calendar = new FullCalendar.Calendar(calendarEl, {
                
                initialView: 'dayGridMonth', // Muestra el calendario en la vista de mes completo
                selectable: true, // Permite seleccionar fechas en el calendario
                locale: 'es',
                buttonText: {
                    today: 'Hoy', // Cambia "today" a "Hoy"
                },
                // * Función para obtener eventos (disponibilidades) del servidor
                events: function(fetchInfo, successCallback, failureCallback) {
                    //fetch(`/admin/disponibilidad/dias/${medico_id}`) // Usa el medico_id seleccionado
                    console.log(`Solicitando disponibilidad de días para el médico con ID: ${medico_id}`);
                    fetch(`/admin/disponibilidad/dias-medico/${medico_id}`) // Usar la nueva ruta con el `medico_id`
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta de la red');
                            }
                            return response.json(); // Convierte la respuesta a formato JSON
                        })
                        .then(data => {
                            // if (data.length === 0) {
                            //     console.warn('No hay disponibilidades para este médico.');
                            // }
                            console.log('Disponibilidades recibidas:', data); // Log de los datos recibidos
                            
                            if (!data.error) {
                            var events = data.map(disponibilidad => {
                                return {
                                    title: disponibilidad.total_disponibilidades > 0 ? 'Disponible' : 'No Disponible',
                                    start: disponibilidad.fecha,
                                    backgroundColor: disponibilidad.total_disponibilidades > 0 ? '#28a745' : '#dc3545',
                                    borderColor: disponibilidad.total_disponibilidades > 0 ? '#28a745' : '#dc3545'
                                };
                            });
                            successCallback(events);
                            } else {
                                console.error('Error al recibir las disponibilidades del backend:', data.error);
                                failureCallback(data.error);
                            }

                        })

                        .catch(error => {
                            console.error('Error al obtener las disponibilidades:', error);
                            failureCallback(error);
                        });
                },
                // * Función que se ejecuta cuando se hace clic en una fecha
                dateClick: function(info) {
                    var fecha = info.dateStr; // Fecha seleccionada
                    console.log('Fecha seleccionada:', fecha);
                    console.log(`Fecha seleccionada: ${fecha} para médico ID: ${medico_id}`);

                    fetch(`/admin/disponibilidad/horarios/${medico_id}/${fecha}`) // Usa el medico_id seleccionado
                        .then(response => {
                            if (!response.ok) {
                                console.error('Error en la respuesta de la red al obtener horarios.');
                                throw new Error('Error en la respuesta de la red');
                            }
                            return response.json(); // Convierte la respuesta a formato JSON
                        })
                        .then(data => {
                            console.log('Horarios recibidos:', data); // Log de los horarios recibidos
                            if (!data.error && data.length > 0) {
                                calendar.getEventSources().forEach(eventSource => {
                                    eventSource.remove(); // Elimina las fuentes de eventos anteriores
                                });

                                var events = data.map(horario => {
                                    return {
                                        title: 'Disponible',
                                        start: `${horario.fecha}T${horario.horaInicio}`,
                                        end: `${horario.fecha}T${horario.horaFin}`,
                                        backgroundColor: '#28a745',
                                        borderColor: '#28a745'
                                    };
                                });

                                calendar.addEventSource(events);
                                calendar.changeView('timeGridDay', fecha);
                            } else {
                                console.warn('No hay disponibilidad para esta fecha o error en la respuesta.');
                                alert('No hay disponibilidad para esta fecha.');
                            }
                        })
                        .catch(error => {
                            console.error('Error al obtener los horarios:', error);
                            alert('Error al obtener los horarios.');
                        });
                }
            });
            calendar.render();
            console.log('Calendario renderizado correctamente.');
        }

        
    
        //Evento de clic en el botón "Confirmar Médico"
        var confirmarMedicoBtn = document.getElementById('confirmarMedicoBtn');
        if (confirmarMedicoBtn) {
            console.log('Botón "Confirmar Médico" encontrado:', confirmarMedicoBtn);

            var selectMedico = document.getElementById('medico_id'); // Elemento select de médico
            var medico_id = selectMedico.options[selectMedico.selectedIndex].value; // Captura el valor del médico seleccionado

            confirmarMedicoBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir que el formulario se envíe y la página se recargue
                var medico_id = document.getElementById('medico_id').value; // Cambiado a medico_id
                console.log('Médico confirmado:', medico_id);
                if (medico_id) { // Si se selecciona un médico válido
                    inicializarCalendario(medico_id); // Inicializa el calendario con el nuevo médico
                } else {
                    console.warn('No se ha seleccionado un médico válido.');
                }
            });
        } else {
            console.error('Botón "Confirmar Médico" no encontrado.');
        }

    });

    
</script>


{{-- <script>
    // * Asegura que el DOM esté completamente cargado antes de ejecutar el script
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM cargado');

      //alert('Valor interpolado de medico_id: {{ $medico_id }}');
      var calendarEl = document.getElementById('calendar');
      console.log('Elemento calendario:', calendarEl);
      //var medico_id = {{ $medico_id }}; // Obtiene el ID del médico seleccionado
      var medico_id = {{ json_encode(session()->get('medico_id')) }};  
      console.log('ID del médico:', medico_id);
    //   if (medico_id !== null && medico_id !== undefined) {
    //         dd(medico_id);
    //     } else {
    //         echo "El valor de medico_id es null o undefined";
    //     }
      //alert('El ID del médico es: ' + medico_id);
      //dd(medico_id); // Verificar el valor de medico_id

      fetch(`/admin/disponibilidad/dias/${medico_id}`) 
        .then(response => response.json())
        .then(respuesta => {
            const medicoId = respuesta.medicoId; // Obtener el ID del médico desde la respuesta
            console.log('Médico ID:', medicoId);

      // * Inicializa el calendario utilizando FullCalendar
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Muestra el calendario en la vista de mes completo
        selectable: true, // Permite seleccionar fechas en el calendario
        locale: 'es',
        
        buttonText: {
            today: 'Hoy', // Cambia "today" a "Hoy"
        },


        // * Función para obtener eventos (disponibilidades) del servidor
        events: function(fetchInfo, successCallback, failureCallback) {
            // Realiza la solicitud al servidor para obtener la disponibilidad diaria
            fetch(`/admin/disponibilidad/dias/${medico_id}`)
                .then(response => {
                    // Verifica si la respuesta HTTP fue exitosa
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la red');
                    }
                    return response.json(); // Convierte la respuesta a formato JSON
                })
                .then(data => {
                    // Mapea los datos obtenidos para crear los eventos en el calendario
                    var events = data.map(disponibilidad => {
                        return {
                            title: disponibilidad.total_disponibilidades > 0 ? 'Disponible' : 'No Disponible',
                            start: disponibilidad.fecha,
                            backgroundColor: disponibilidad.total_disponibilidades > 0 ? '#28a745' : '#dc3545',
                            borderColor: disponibilidad.total_disponibilidades > 0 ? '#28a745' : '#dc3545'
                        };
                    });
                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error al obtener las disponibilidades:', error);
                    failureCallback(error);
                });
        },
        
        
                    // * Función que se ejecuta cuando se hace clic en una fecha
                dateClick: function(info) {
                var fecha = info.dateStr; // Fecha seleccionada
                console.log('Fecha seleccionada:', fecha);

                // Cambiar la vista a timeGridDay para mostrar los horarios disponibles en el día seleccionado
                //calendar.changeView('timeGridDay', fecha);

                // Actualizar los eventos en la vista de día para mostrar solo los horarios disponibles en la fecha seleccionada
                fetch(`/admin/disponibilidad/horarios/${medico_id}/${fecha}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta de la red');
                        }
                        return response.json(); // Convierte la respuesta a formato JSON
                    })
                    .then(data => {
                        if (data.length > 0) {
                            // Limpiar eventos anteriores para evitar duplicados en la vista
                            calendar.getEventSources().forEach(eventSource => {
                                eventSource.remove(); // Elimina las fuentes de eventos anteriores
                            });

                            // Mapear los datos de horarios a eventos en la vista de día
                            var events = data.map(horario => {
                                return {
                                    title: 'Disponible',
                                    start: `${horario.fecha}T${horario.horaInicio}`,
                                    end: `${horario.fecha}T${horario.horaFin}`,
                                    backgroundColor: '#28a745',
                                    borderColor: '#28a745'
                                    // Propiedades adicionales para identificar el horario
                                    // ID del horario en la base de datos
                                    // extendedProps: {             
                                    //     id: horario.id           
                                    // }
                                };
                            });

                            // Añadir los eventos al calendario
                            calendar.addEventSource(events);

                            // Cambiar a la vista de día para mostrar los horarios específicos
                            calendar.changeView('timeGridDay', fecha);

                        } else {
                            alert('No hay disponibilidad para esta fecha.');
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los horarios:', error);
                        alert('Error al obtener los horarios.');
                    });
            }

           

        
        // // * Función que se ejecuta cuando se hace clic en una fechav
        // dateClick: function(info) {
        //     var fecha = info.dateStr; // Fecha seleccionada
        //     fetch(`/admin/disponibilidad/horarios/${medico_id}/${fecha}`)
        //         //.then(response => response.json())
        //         .then(response => {
        //                 if (!response.ok) {
        //                     throw new Error('Error en la respuesta de la red');
        //                 }
        //                 return response.json();
        //             })
        //         .then(data => {
        //             if (data.length > 0) {
        //                 // Aquí puedes mostrar un modal o lista con los horarios disponibles
        //                 console.log('Horarios disponibles:', data);
        //             } else {
        //                 alert('No hay disponibilidad para esta fecha.');
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error al obtener los horarios:', error);
        //             alert('Error al obtener los horarios.');
        //         });
        // }
        

      });
      calendar.render();
        });

    });
  </script> --}}
  


@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi Agenda</h1>

    @if($citas->isEmpty())
        <p>No tienes citas programadas.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Especialidad</th>
                    <th>Paciente</th>
                    <th>Edad</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                <tr>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                    <td>{{ $cita->especialidad->nombre }}</td>
                    <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->paciente->fechaNacimiento)->age }} años</td>
                    <td>{{ $cita->motivo ?? 'Consulta general' }}</td> <!-- Motivo por defecto si no está definido -->
                    <td>
                        <a href="{{ route('medico.atenderCita', $cita->id) }}" class="btn btn-primary">Atender</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi Agenda</h1>

    <!-- Verificar si no hay citas programadas -->
    @if(empty($citas))
        <p>No tienes citas programadas.</p>
    @else
        <table id="agenda-table" class="table mt-3">
            <thead>
                <tr>
                    <th>Fecha</th> <!-- Columna para la fecha de la cita -->
                    <th>Hora</th> <!-- Columna para el horario de la cita -->
                    <th>Especialidad</th> <!-- Columna para la especialidad médica de la cita -->
                    <th>Paciente</th> <!-- Columna para el nombre del paciente -->
                    <th>Edad</th> <!-- Columna para la edad del paciente -->
                    <th>Acciones</th> <!-- Columna para las acciones disponibles (e.g., Atender) -->
                </tr>
            </thead>
            <tbody>
                <!-- Iterar a través de cada cita en la lista de citas -->
                @foreach($citas as $cita)

                @php
                    // Registrar en el log el ID de la cita que se está mostrando
                    Log::info("cita_id en la vista: " . $cita->cita_id);
                @endphp

                <tr>
                    <!-- Mostrar la fecha de la cita -->
                    <td>{{ $cita->fecha_cita }}</td>
                    
                    <!-- Mostrar el rango de horas de la cita -->
                    <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                    
                    <!-- Mostrar el nombre de la especialidad médica de la cita -->
                    <td>{{ $cita->especialidad_nombre }}</td>
                    
                    <!-- Mostrar el nombre completo del paciente -->
                    <td>{{ $cita->paciente_nombre }} {{ $cita->paciente_apellidos }}</td>
                    
                    <!-- Calcular y mostrar la edad del paciente usando Carbon -->
                    <td>
                        {{ \Carbon\Carbon::parse($cita->fecha_nacimiento)->age }} años
                    </td>
                    
                    <!-- Botón para que el médico atienda la cita específica -->
                    <td>
                        <a href="{{ route('medico.atenderCita', $cita->cita_id) }}" class="btn btn-primary">Atender</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection


@push('scripts')
    
<script>
    $(document).ready(function() {
        $('#agenda-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" // Opcional: para cambiar el idioma a español
            }
        });
    });
</script>
@endpush
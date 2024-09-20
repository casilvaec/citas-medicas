@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Lista de Triajes</h2>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Paciente</th>
                <th>Frecuencia Cardíaca</th>
                <th>Frecuencia Respiratoria</th>
                <th>Presión Arterial (Mín - Máx)</th>
                <th>Temperatura Corporal</th>
                <th>Saturación de Oxígeno</th>
                <th>Prioridad</th>
                <th>Estado de Atención</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($triajes as $triaje)
                <tr>
                    <!-- Usamos la relación 'user' para obtener los datos del paciente -->
                    {{-- <td>{{ $triaje->paciente->nombre }} {{ $triaje->paciente->apellidos }}</td> --}}
                    <td>{{ $triaje->paciente->user->nombre }} {{ $triaje->paciente->user->apellidos }}</td>
                    <td>{{ $triaje->frecuenciaCardiaca }} latidos/min</td>
                    <td>{{ $triaje->frecuenciaRespiratoria }} respiraciones/min</td>
                    <td>{{ $triaje->presionArterialMin }} - {{ $triaje->presionArterialMax }} mmHg</td>
                    <td>{{ $triaje->temperaturaCorporal }} °C</td>
                    <td>{{ $triaje->saturacionOxigeno }} %</td>
                    <td>{{ $triaje->prioridad }}</td>
                    <td>{{ $triaje->estadoAtencion }}</td>
                    <td>{{ $triaje->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('medico.triajes.editar', $triaje->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('medico.triajes.eliminar', $triaje->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este triaje? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

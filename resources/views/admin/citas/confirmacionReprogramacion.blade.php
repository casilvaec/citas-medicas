@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Confirmación de Reprogramación de Cita</h2>

    <div class="alert alert-success">
        La cita ha sido reprogramada exitosamente. A continuación se muestran los detalles de la cita reagendada.
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Paciente</th>
            <td>{{ $cita->paciente_nombre }} {{ $cita->paciente_apellido }}</td>
        </tr>
        <tr>
            <th>Médico</th>
            <td>{{ $cita->medico_nombre }} {{ $cita->medico_apellido }}</td>
        </tr>
        <tr>
            <th>Especialidad</th>
            <td>{{ $cita->especialidad_nombre }}</td>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d-M-Y') }}</td>
        </tr>
        <tr>
            <th>Hora</th>
            <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>{{ $cita->estado }}</td>
        </tr>
    </table>

    <a href="{{ route('admin.citas.index') }}" class="btn btn-primary">Volver a la Lista de Citas</a>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agenda de Citas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Especialidad</th>
                <th>Paciente</th>
                <th>Edad</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td>{{ $cita->fecha }}</td>
                <td>{{ $cita->hora_inicio }}</td>
                <td>{{ $cita->hora_fin }}</td>
                <td>{{ $cita->especialidad->nombre }}</td>
                <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
                <td>{{ \Carbon\Carbon::parse($cita->paciente->fecha_nacimiento)->age }} años</td>
                <td>{{ $cita->motivo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

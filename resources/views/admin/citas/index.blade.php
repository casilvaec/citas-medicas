{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Citas</h1>
    <a href="{{ route('admin.citas.create') }}" class="btn btn-primary">Agendar Nueva Cita</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td>{{ $cita->id }}</td>
                <td>{{ $cita->paciente->nombre }}</td>
                <td>{{ $cita->medico->usuario->nombre }}</td>
                <td>{{ $cita->especialidad->nombre }}</td>
                <td>{{ $cita->fecha }}</td>
                <td>{{ $cita->hora_inicio }}</td>
                <td>{{ $cita->hora_fin }}</td>
                <td>{{ $cita->estado }}</td>
                <td>
                    <a href="{{ route('admin.citas.edit', $cita->id) }}" class="btn btn-warning">Editar</a>
                    <a href="{{ route('admin.citas.cancel', $cita->id) }}" class="btn btn-danger">Cancelar</a>
                    <a href="{{ route('admin.citas.reschedule', $cita->id) }}" class="btn btn-info">Reprogramar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Citas</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.citas.create') }}" class="btn btn-primary mb-3">Agendar Nueva Cita</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td>{{ $cita->id }}</td>
                <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos }}</td>
                <td>{{ $cita->medico->user->nombre }} {{ $cita->medico->user->apellidos }}</td>
                <td>{{ $cita->especialidad->nombre }}</td>
                <td>{{ $cita->fecha }}</td>
                <td>{{ $cita->hora_inicio }}</td>
                <td>{{ $cita->hora_fin }}</td>
                <td>{{ $cita->estado }}</td>
                <td>
                    <a href="{{ route('admin.citas.edit', $cita->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('admin.citas.cancel', $cita->id) }}" class="btn btn-danger btn-sm">Cancelar</a>
                    <a href="{{ route('admin.citas.reschedule', $cita->id) }}" class="btn btn-info btn-sm">Reprogramar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

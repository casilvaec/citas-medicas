@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Horarios Médicos</h1>
    <a href="{{ route('admin.horarios_medicos.create') }}" class="btn btn-primary mb-3">Agregar Horario</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Día de la Semana</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
            <tr>
                <td>{{ $horario->id }}</td>
                <td>{{ $horario->medico->nombre }} {{ $horario->medico->apellido }}</td>
                <td>{{ $horario->diaSemana }}</td>
                <td>{{ $horario->horaInicio }}</td>
                <td>{{ $horario->horaFin }}</td>
                <td>
                    <a href="{{ route('admin.horarios_medicos.edit', $horario->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.horarios_medicos.destroy', $horario->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

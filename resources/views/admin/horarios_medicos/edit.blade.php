@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Horario Médico</h1>
    <form action="{{ route('admin.horarios_medicos.update', $horario->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="medicoId">Médico</label>
            <select name="medicoId" id="medicoId" class="form-control">
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id }}" {{ $horario->medicoId == $medico->id ? 'selected' : '' }}>{{ $medico->nombre }} {{ $medico->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="diaSemana">Día de la Semana</label>
            <input type="text" name="diaSemana" id="diaSemana" class="form-control" value="{{ $horario->diaSemana }}">
        </div>
        <div class="form-group">
            <label for="horaInicio">Hora Inicio</label>
            <input type="time" name="horaInicio" id="horaInicio" class="form-control" value="{{ $horario->horaInicio }}">
        </div>
        <div class="form-group">
            <label for="horaFin">Hora Fin</label>
            <input type="time" name="horaFin" id="horaFin" class="form-control" value="{{ $horario->horaFin }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

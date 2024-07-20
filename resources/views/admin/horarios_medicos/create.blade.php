@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Horario Médico</h1>
    <form action="{{ route('admin.horarios_medicos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="medicoId">Médico</label>
            <select name="medicoId" id="medicoId" class="form-control">
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id }}">{{ $medico->nombre }} {{ $medico->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="diaSemana">Día de la Semana</label>
            <input type="text" name="diaSemana" id="diaSemana" class="form-control">
        </div>
        <div class="form-group">
            <label for="horaInicio">Hora Inicio</label>
            <input type="time" name="horaInicio" id="horaInicio" class="form-control">
        </div>
        <div class="form-group">
            <label for="horaFin">Hora Fin</label>
            <input type="time" name="horaFin" id="horaFin" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

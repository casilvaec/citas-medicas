@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Disponibilidad de Médico</h1>
    <form action="{{ route('admin.disponibilidad_medicos.update', $disponibilidad->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="medicoId">Médico</label>
            <select name="medicoId" id="medicoId" class="form-control">
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id }}" {{ $disponibilidad->medicoId == $medico->id ? 'selected' : '' }}>{{ $medico->nombre }} {{ $medico->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $disponibilidad->fecha }}">
        </div>
        <div class="form-group">
            <label for="horaInicio">Hora Inicio</label>
            <input type="time" name="horaInicio" id="horaInicio" class="form-control" value="{{ $disponibilidad->horaInicio }}">
        </div>
        <div class="form-group">
            <label for="horaFin">Hora Fin</label>
            <input type="time" name="horaFin" id="horaFin" class="form-control" value="{{ $disponibilidad->horaFin }}">
        </div>
        <div class="form-group">
            <label for="disponible">Disponible</label>
            <select name="disponible" id="disponible" class="form-control">
                <option value="1" {{ $disponibilidad->disponible ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$disponibilidad->disponible ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reprogramar Cita</h1>
    <form action="{{ route('admin.citas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="fecha">Nueva Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $cita->fecha }}">
        </div>
        <div class="form-group">
            <label for="hora_inicio">Nueva Hora de Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ $cita->hora_inicio }}">
        </div>
        <div class="form-group">
            <label for="hora_fin">Nueva Hora de Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ $cita->hora_fin }}">
        </div>
        <button type="submit" class="btn btn-primary">Reprogramar Cita</button>
    </form>
</div>
@endsection

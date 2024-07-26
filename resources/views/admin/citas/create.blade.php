@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agendar Nueva Cita</h1>
    <form action="{{ route('admin.citas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control">
                <!-- Lógica para listar pacientes -->
            </select>
        </div>
        <div class="form-group">
            <label for="medico_id">Médico</label>
            <select name="medico_id" id="medico_id" class="form-control">
                <!-- Lógica para listar médicos -->
            </select>
        </div>
        <div class="form-group">
            <label for="especialidad_id">Especialidad</label>
            <select name="especialidad_id" id="especialidad_id" class="form-control">
                <!-- Lógica para listar especialidades -->
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control">
        </div>
        <div class="form-group">
            <label for="hora_inicio">Hora de Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control">
        </div>
        <div class="form-group">
            <label for="hora_fin">Hora de Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control">
        </div>
        <div class="form-group">
            <label for="motivo">Motivo</label>
            <input type="text" name="motivo" id="motivo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Agendar Cita</button>
    </form>
</div>
@endsection

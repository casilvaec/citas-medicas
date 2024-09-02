@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Atención al Paciente</h1>

    <!-- Mostrar los detalles del paciente y la cita -->
    <h3>Datos del Paciente</h3>
    <p><strong>Nombre:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos }}</p>
    <p><strong>Edad:</strong> {{ \Carbon\Carbon::parse($cita->paciente->fechaNacimiento)->age }} años</p>
    <p><strong>Fecha de la Cita:</strong> {{ $cita->fecha }}</p>
    <p><strong>Hora de la Cita:</strong> {{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</p>
    <p><strong>Especialidad:</strong> {{ $cita->especialidad->nombre }}</p>

    <!-- Formulario para registrar la atención -->
    <form action="{{ route('medico.registrarAtencion', $cita->id) }}" method="POST">
        @csrf
        
        <!-- Campo para registrar el diagnóstico del paciente -->
        <div class="form-group">
            <label for="diagnostico">Diagnóstico:</label>
            <textarea name="diagnostico" id="diagnostico" class="form-control" required></textarea>
        </div>

        <!-- Campo para registrar los exámenes solicitados -->
        <div class="form-group">
            <label for="examenes">Exámenes Solicitados:</label>
            <textarea name="examenes" id="examenes" class="form-control"></textarea>
        </div>

        <!-- Campo para registrar la receta médica -->
        <div class="form-group">
            <label for="receta">Receta Médica:</label>
            <textarea name="receta" id="receta" class="form-control"></textarea>
        </div>

        <!-- Campo para registrar la fecha del próximo control -->
        <div class="form-group">
            <label for="proximo_control">Fecha de Próximo Control:</label>
            <input type="date" name="proximo_control" id="proximo_control" class="form-control">
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-success">Registrar Atención</button>
    </form>
</div>
@endsection


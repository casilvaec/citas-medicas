<!-- resources/views/admin/citas/confirmacion.blade.php -->

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Confirmación de Cita</h1>

    <p>La cita ha sido agendada exitosamente.</p>

    <p><strong>Paciente:</strong> {{ $usuario_nombre }} {{ $usuario_apellidos }}</p>
    <p><strong>Médico:</strong> {{ $medico_nombre }} {{ $medico_apellidos }}</p>
    <p><strong>Especialidad Médica:</strong> {{ $especialidad }}</p>
    <p><strong>Fecha de la Cita:</strong> {{ $fecha_cita }}</p>
    <p><strong>Horario:</strong> {{ $horario_cita }}</p>
    {{-- <ul>
        <li><strong>Paciente:</strong> {{ $usuario_id }}</li>
        <li><strong>Médico:</strong> {{ $medico_id }}</li>
        <li><strong>Fecha de la Cita:</strong> {{ $fecha_cita }}</li>
        <li><strong>Horario:</strong> {{ $horario_cita }}</li>
    </ul> --}}

    {{-- <a href="{{ route('admin.citas.index') }}" class="btn btn-primary">Volver a la Lista de Citas</a>
</div>
@endsection --}}

<!-- resources/views/admin/citas/confirmacion.blade.php -->

<!--
    Objetivo de la Vista:
    La vista confirmacion.blade.php tiene como objetivo mostrar los detalles de una cita médica que ha sido confirmada por un paciente.
    Esta vista presenta información clave como el nombre del paciente, el médico, la especialidad, la fecha, la hora y el estado de la cita.
-->

@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Título de la página -->
    <h1>Confirmación de Cita</h1>

    <!-- Mensaje de confirmación -->
    <p>La cita ha sido agendada exitosamente.</p>

    <!-- Mostrar detalles de la cita -->
    <div class="card">
        <div class="card-header">
            Detalles de la Cita
        </div>
        <div class="card-body">
            <!-- Nombre del paciente -->
            <p><strong>Paciente:</strong> {{ $usuario_nombre }} {{ $usuario_apellidos }}</p>
            
            <!-- Nombre del médico -->
            <p><strong>Médico:</strong> {{ $medico_nombre }} {{ $medico_apellidos }}</p>
            
            <!-- Especialidad médica -->
            <p><strong>Especialidad Médica:</strong> {{ $especialidad }}</p>
            
            <!-- Fecha de la cita -->
            <p><strong>Fecha de la Cita:</strong> {{ $fecha_cita }}</p>
            
            <!-- Horario de la cita -->
            <p><strong>Horario:</strong> {{ $horario_cita }}</p>
            
        
        </div>
    </div>

    <!-- Botón para volver a la lista de citas -->
    <a href="{{ route('admin.citas.index') }}" class="btn btn-primary mt-3">Volver a la Lista de Citas</a>
</div>
@endsection


<!-- resources/views/admin/citas/confirmacion.blade.php -->

@extends('layouts.app')

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

    <a href="{{ route('admin.citas.index') }}" class="btn btn-primary">Volver a la Lista de Citas</a>
</div>
@endsection

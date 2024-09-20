<!-- resources/views/dashboard/medico.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel del Médico</h1>

    <!-- Mostrar el nombre del médico y su rol -->
    <p>Bienvenido(a), {{ $nombre }} {{ $apellido }}.</p>
    <p>Tu rol es: {{ $rol }}</p>

    <!-- Botones para funciones del médico -->
    <a href="{{ url('/medico/buscar-agenda') }}" class="btn btn-primary">Revisar Agenda</a>
    <a href="{{ url('/medico/historias-clinicas') }}" class="btn btn-secondary">Historia Clínica de Pacientes</a>
    <a href="{{ url('/profile/edit') }}" class="btn btn-info">Ver Perfil Personal</a>

    <!-- Botón nuevo para Gestionar Triajes -->
    
    <a href="{{ url('/medico/triaje') }}" class="btn btn-warning">Registrar Triaje</a>

    <!-- Botón nuevo para Ver Triajes -->
    <a href="{{ url('/medico/triajes') }}" class="btn btn-info">Ver Triajes</a>


</div>
@endsection

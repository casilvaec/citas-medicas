
{{-- <!-- resources/views/patient/dashboard.blade.php -->
asi estaba primero 

<!DOCTYPE html>
<html>
<head>
    <title>Panel del Paciente</title>
</head>
<body>
    <h1>Bienvenido, Paciente</h1>
    <nav>
        <ul>
            <li><a href="{{ route('patient.appointments.schedule') }}">Agendar Cita Médica</a></li>
            <!-- Puedes agregar más enlaces aquí -->
        </ul>
    </nav>
</body>
</html> --}}





@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Gestión de Citas Médicas</h1>
    <nav class="d-flex flex-column align-items-center">
        <a href="{{ route('patient.appointments.schedule') }}" class="btn btn-primary my-2">
            Agendar Cita
        </a>
        <a href="{{ route('patient.appointments.cancel') }}" class="btn btn-primary my-2">
            Cancelar Cita
        </a>
        <a href="{{ route('patient.profile.edit') }}" class="btn btn-primary my-2">
            Editar Perfil
        </a>
        <a href="{{ route('logout') }}" class="btn btn-primary my-2">
            Cerrar Sesión
        </a>
    </nav>
</div>
@endsection


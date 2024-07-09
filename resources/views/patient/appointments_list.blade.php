@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Mis Citas Programadas</h1>
    <ul class="list-group mb-4">
        <!-- Mostrar las citas aquí -->
        <li class="list-group-item">Especialidad: Cardiología, Doctor: Dr. Smith, Fecha y Hora: 10/10/2024 10:00 AM</li>
        <li class="list-group-item">Especialidad: Dermatología, Doctor: Dr. Jones, Fecha y Hora: 11/10/2024 11:00 AM</li>
        <li class="list-group-item">Especialidad: Pediatría, Doctor: Dr. Brown, Fecha y Hora: 12/10/2024 12:00 PM</li>
    </ul>
    <div class="text-center">
        <a href="{{ route('patient.dashboard') }}" class="btn btn-primary mx-2">Regresar al Panel de Control</a>
        <a href="{{ route('logout') }}" class="btn btn-danger mx-2">Cerrar Sesión</a>
    </div>
</div>
@endsection

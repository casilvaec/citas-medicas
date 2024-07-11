<!-- resources/views/patient/appointments_list.blade.php -->

<!-- resources/views/patient/appointments_list.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Mis Citas Programadas</h1>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <ul class="list-group mb-4">
        @foreach ($appointments as $appointment)
            @if (session('cancelled_id') != $appointment['id'])
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        Especialidad: {{ $appointment['specialty'] }}, Doctor: {{ $appointment['doctor'] }}, Fecha y Hora: {{ $appointment['datetime'] }}
                    </div>
                    <form method="post" action="{{ route('patient.appointments.cancelAppointment') }}">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointment['id'] }}">
                        <button type="submit" class="btn btn-danger">Cancelar Cita</button>
                    </form>
                </li>
            @endif
        @endforeach
    </ul>
    <div class="text-center">
        <a href="{{ route('patient.dashboard') }}" class="btn btn-primary mx-2">Volver al Panel de Control</a>
    </div>
</div>
@endsection



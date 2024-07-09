@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Citas</h1>
    <ul>
        <!-- Lista de citas -->
        <li>
            Especialidad: Cardiología, Doctor: Dr. Smith, Fecha y Hora: 10/10/2024 10:00 AM
            <form method="post" action="{{ route('patient.appointments.cancel') }}">
                @csrf
                <button type="submit">Cancelar</button>
            </form>
        </li>
    </ul>
</div>
@endsection

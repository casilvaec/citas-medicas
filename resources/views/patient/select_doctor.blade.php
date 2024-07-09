@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seleccionar Doctor</h1>
    <form method="post" action="{{ route('patient.appointments.confirm') }}">
        @csrf
        <div>
            <label for="doctor">Doctor:</label>
            <select id="doctor" name="doctor">
                <!-- Opciones de doctores -->
            </select>
        </div>
        <button type="submit">Siguiente</button>
    </form>
</div>
@endsection

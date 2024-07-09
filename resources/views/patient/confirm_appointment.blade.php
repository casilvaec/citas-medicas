@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Confirmación de Cita</h1>
    <p>Detalles de la cita: Especialidad, Doctor, Fecha y Hora</p>
    <form method="post" action="{{ route('patient.dashboard') }}">
        @csrf
        <button type="submit">Confirmar</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Triaje del Paciente: {{ $triaje->paciente->user->nombre }} {{ $triaje->paciente->user->apellidos }}</h2>

    <!-- Formulario para editar los signos vitales -->
    <form action="{{ route('medico.triajes.actualizar', $triaje->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="frecuenciaCardiaca">Frecuencia Cardíaca (latidos/minuto):</label>
            <input type="number" name="frecuenciaCardiaca" class="form-control" value="{{ $triaje->frecuenciaCardiaca }}" required>
        </div>

        <div class="form-group">
            <label for="frecuenciaRespiratoria">Frecuencia Respiratoria (respiraciones/minuto):</label>
            <input type="number" name="frecuenciaRespiratoria" class="form-control" value="{{ $triaje->frecuenciaRespiratoria }}" required>
        </div>

        <div class="form-group">
            <label for="presionArterialMin">Presión Arterial Mínima (mmHg):</label>
            <input type="number" name="presionArterialMin" class="form-control" value="{{ $triaje->presionArterialMin }}" required>
        </div>

        <div class="form-group">
            <label for="presionArterialMax">Presión Arterial Máxima (mmHg):</label>
            <input type="number" name="presionArterialMax" class="form-control" value="{{ $triaje->presionArterialMax }}" required>
        </div>

        <div class="form-group">
            <label for="temperaturaCorporal">Temperatura Corporal (°C):</label>
            <input type="number" name="temperaturaCorporal" class="form-control" value="{{ $triaje->temperaturaCorporal }}" required>
        </div>

        <div class="form-group">
            <label for="saturacionOxigeno">Saturación de Oxígeno (SpO2):</label>
            <input type="number" name="saturacionOxigeno" class="form-control" value="{{ $triaje->saturacionOxigeno }}" required>
        </div>

        

        <button type="submit" class="btn btn-primary">Actualizar Triaje</button>
    </form>
</div>
@endsection

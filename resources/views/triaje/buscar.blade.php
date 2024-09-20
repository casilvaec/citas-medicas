

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Buscar Paciente para Triaje</h3>
        </div>
        <div class="card-body">
            <!-- Formulario de búsqueda de paciente -->
            <form action="{{ route('medico.triaje.buscar') }}" method="GET" class="mb-4">
                <div class="form-group">
                    <label for="busquedaPaciente">Número de Identificación:</label>
                    <input type="text" class="form-control" name="busquedaPaciente" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Buscar</button>
            </form>

           

            <!-- Si se ha encontrado el paciente, mostrar sus datos y formulario de signos vitales -->
            @isset($paciente)
                <!-- Datos del paciente -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h4>Datos del Paciente</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $paciente->nombre }} {{ $paciente->apellidos }}</p>
                        <p><strong>Número de Identificación:</strong> {{ $paciente->numeroIdentificacion }}</p>
                        <p><strong>Edad:</strong> {{ $edad }} años</p>
                        <p><strong>Género:</strong> {{ $paciente->genero->nombre }}</p> <!-- Aquí mostramos el género -->
                    </div>
                </div>

                <!-- Formulario para registrar los signos vitales -->
                <h4 class="text-primary">Registrar Signos Vitales</h4>
                <form action="{{ route('medico.triaje.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pacienteId" value="{{ $paciente->id }}"> <!-- ID del paciente oculto -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="frecuenciaCardiaca">Frecuencia Cardíaca (latidos/minuto):</label>
                                <input type="number" class="form-control" name="frecuenciaCardiaca" min="60" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="frecuenciaRespiratoria">Frecuencia Respiratoria (respiraciones/minuto):</label>
                                <input type="number" class="form-control" name="frecuenciaRespiratoria" min="12" max="20" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="presionArterialMin">Presión Arterial Mínima (mmHg):</label>
                                <input type="number" class="form-control" name="presionArterialMin" min="80" max="84" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="presionArterialMax">Presión Arterial Máxima (mmHg):</label>
                                <input type="number" class="form-control" name="presionArterialMax" min="120" max="129" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temperaturaCorporal">Temperatura Corporal (°C):</label>
                                <input type="number" class="form-control" name="temperaturaCorporal" min="12" max="40" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="saturacionOxigeno">Saturación de Oxígeno (SpO2):</label>
                                <input type="number" class="form-control" name="saturacionOxigeno" min="70" max="100" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Registrar Triaje</button>
                </form>
            @endisset
        </div>
    </div>
</div>
@endsection


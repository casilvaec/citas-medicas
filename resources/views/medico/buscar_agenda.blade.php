@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscar Agenda del Médico</h1>

    <!-- Formulario para buscar el médico por número de identificación -->
    <form action="{{ route('medico.buscarAgenda') }}" method="GET">
        <div class="form-group">
            <label for="numeroIdentificacion">Número de Identificación del Médico:</label>
            <input type="text" name="numeroIdentificacion" id="numeroIdentificacion" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Buscar Agenda</button>
    </form>
</div>
@endsection

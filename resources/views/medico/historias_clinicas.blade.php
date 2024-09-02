{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial Médico de {{ $paciente->nombre }} {{ $paciente->apellido }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Diagnóstico</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historial as $registro)
            <tr>
                <td>{{ $registro->fecha }}</td>
                <td>{{ $registro->descripcion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscar Historia Clínica del Paciente</h1>

    <!-- Formulario para buscar la historia clínica del paciente por identificación -->
    <form action="{{ route('medico.consultarHistoriaClinica') }}" method="GET">
        <div class="form-group">
            <label for="identificacion">Número de Identificación del Paciente:</label>
            <input type="text" name="identificacion" id="identificacion" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    @if(!empty($historiasClinicas))
        <h2 class="mt-4">Resultados de la Historia Clínica</h2>

        <!-- Tabla de resultados con DataTables -->
        <table id="historia-clinica-table" class="table mt-3">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Especialidad</th>
                    <th>Diagnóstico</th>
                    <th>Exámenes</th>
                    <th>Receta</th>
                    <th>Próximo Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historiasClinicas as $historia)
                <tr>
                    {{-- <td>{{ $historia->fechaHora }}</td> --}}
                    <td>{{ \Carbon\Carbon::parse($historia->fechaHora)->format('Y-m-d') }}</td>
                    <td>{{ $historia->especialidad_nombre }}</td>
                    <td>{{ $historia->diagnostico }}</td>
                    <td>{{ $historia->examenes }}</td>
                    <td>{{ $historia->receta }}</td>
                    <td>{{ $historia->proximoControl }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($identificacion))
        <p>No se encontraron historias clínicas para el paciente con identificación: {{ $identificacion }}</p>
    @endif
</div>
@endsection

@push('scripts')
    
<script>
    $(document).ready(function() {
        $('#historia-clinica-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" // Opcional: para cambiar el idioma a español
            }
        });
    });
</script>
@endpush
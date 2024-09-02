@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Citas Médicas</h1>
    
    <!-- Mostrar mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabla para mostrar las citas médicas -->
    <table id="tabla-citas" class="table mt-3">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    {{-- <td>{{ $cita->id }}</td> --}}
                    
                    <td>{{ $cita->paciente_nombre }} {{ $cita->paciente_apellido }}</td>
                    <td>{{ $cita->medico_nombre }} {{ $cita->medico_apellido }}</td>
                    <td>{{ $cita->especialidad_nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d-M-Y') }}</td>
                    {{-- <td>{{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i:s') }} - {{ \Carbon\Carbon::parse($cita->hora_fin)->format('H:i:s') }}</td> --}}
                    {{-- <td>{{ $cita->fecha }}</td> --}}
                    <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                    <td>{{ trim($cita->estado) }}</td>
                    {{-- <td>
                        <!-- Aquí puedes añadir botones para editar, cancelar o ver detalles de la cita -->
                        <a href="#" class="btn btn-primary">Editar</a>
                        <a href="#" class="btn btn-danger">Cancelar</a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<!-- script para inicializar DataTables -->
@push('scripts')
<script>
    $(document).ready(function() {
        $('#tabla-citas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush
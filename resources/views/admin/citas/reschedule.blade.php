



@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reprogramar Citas Médicas</h2>

    {{-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif --}}

    <table id="citas-table" class="table table-striped">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Fecha Actual</th>
                <th>Hora Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td>{{ $cita->paciente_nombre }} {{ $cita->paciente_apellido }}</td>
                <td>{{ $cita->medico_nombre }} {{ $cita->medico_apellido }}</td>
                <td>{{ $cita->especialidad_nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d-M-Y') }}</td>
                <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                <td>
                    <!-- Botón para reprogramar la cita -->
                    <a href="{{ route('admin.citas.reprogramar', $cita->cita_id) }}" class="btn btn-primary">Reprogramar</a>
                    {{-- <form action="{{ route('admin.citas.update', $cita->cita_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <input type="date" name="fecha" required>
                        <input type="time" name="hora_inicio" required>
                        <input type="time" name="hora_fin" required> --}}
                        {{-- <button type="submit" class="btn btn-primary">Reprogramar</button> --}}
                    {{-- </form> --}}

                </td>
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
        $('#citas-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush
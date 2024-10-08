@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Horarios a Médicos</h2>
    <a href="{{ route('admin.horarios_medicos.create') }}" class="btn btn-primary mb-3">Asignar Horario</a>
    {{-- @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif --}}
    <table id="horarios_medicos-table" class="table mt -3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
            <tr>
                <td>{{ $horario->id }}</td>
                <td>{{ $horario->medico->user->nombre }} {{ $horario->medico->user->apellidos }}</td>
                <td>{{ $horario->fecha }}</td>
                <td>{{ $horario->horaInicio }}</td>
                <td>{{ $horario->horaFin }}</td>
                <td>
                    <a href="{{ route('admin.horarios_medicos.edit', $horario->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.horarios_medicos.destroy', $horario->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
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
        $('#horarios_medicos-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush
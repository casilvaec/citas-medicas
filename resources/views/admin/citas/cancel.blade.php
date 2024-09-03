@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cancelar Citas Médicas</h1>
    
    <!-- Mostrar mensajes de éxito o error -->
    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif --}}

    <table id="citas-table" class="table table-striped">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
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
                <td>{{ $cita->estado }}</td>
                <td>
                    @if($cita->estado != 'Cancelada')
                    <form action="{{ route('admin.citas.cancelar', $cita->cita_id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                    </form>
                    @else
                        <span class="badge badge-secondary">Ya Cancelada</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

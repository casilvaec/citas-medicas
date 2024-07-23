@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reporte de Consultorios</h1>
    <a href="{{ route('consultorios.export') }}" class="btn btn-success">Exportar a Excel</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Consultorio</th>
                <th>Doctor</th>
                <th>Especialidad</th>
                <th>Fecha de Asignación</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultorios as $consultorio)
                <tr>
                    <td>{{ $consultorio->nombre }}</td>
                    <td>{{ $consultorio->medico ? $consultorio->medico->user->nombre . ' ' . $consultorio->medico->user->apellidos : '' }}</td>
                    <td>{{ $consultorio->medico && $consultorio->medico->especialidad ? $consultorio->medico->especialidad->nombre : '' }}</td>
                    <td>{{ $consultorio->fecha_asignacion }}</td>
                    <td>{{ $consultorio->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


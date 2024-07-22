@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignación de Consultorios</h1>
    <a href="{{ route('admin.consultorio_medico.create') }}" class="btn btn-primary">Asignar Consultorio</a>
    <table class="table">
        <thead>
            <tr>
                <th>Consultorio</th>
                <th>Médico</th>
                <th>Fecha de Asignación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultorioMedicos as $cm)
                <tr>
                    <td>{{ $cm->consultorio->nombre }}</td>
                    <td>{{ $cm->medico->user->nombre }} {{ $cm->medico->user->apellidos }}</td>
                    <td>{{ $cm->fecha_asignacion }}</td>
                    <td>
                        <!-- Aquí puedes añadir botones de acción como editar o eliminar -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

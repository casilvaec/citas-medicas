{{-- resources/views/admin/consultorio_medico/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignación de Consultorios</h1>
    <a href="{{ route('admin.consultorio_medico.create') }}" class="btn btn-primary">Asignar Consultorio</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Consultorio</th>
                <th>Médico</th>
                <th>Fecha de Asignación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultorioMedicos as $cm)
                <tr>
                    <td>{{ $cm->id }}</td>
                    <td>{{ optional($cm->consultorio)->nombre }}</td>
                    <td>{{ optional($cm->medico->user)->nombre }} {{ optional($cm->medico->user)->apellidos }}</td>
                    <td>{{ $cm->fecha_asignacion }}</td>
                    <td>
                        <!-- Aquí puedes añadir botones de acción como editar o eliminar -->
                        <a href="{{ route('admin.consultorio_medico.edit', $cm->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.consultorio_medico.destroy', $cm->id) }}" method="POST" style="display:inline;">
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

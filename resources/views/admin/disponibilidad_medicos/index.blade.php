@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Disponibilidad de Médicos</h1>
    <a href="{{ route('admin.disponibilidad_medicos.create') }}" class="btn btn-primary mb-3">Agregar Disponibilidad</a>
    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Disponible</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disponibilidades as $disponibilidad)
            <tr>
                <td>{{ $disponibilidad->id }}</td>
                <td>{{ $disponibilidad->medico->nombre }} {{ $disponibilidad->medico->apellido }}</td>
                <td>{{ $disponibilidad->fecha }}</td>
                <td>{{ $disponibilidad->horaInicio }}</td>
                <td>{{ $disponibilidad->horaFin }}</td>
                <td>{{ $disponibilidad->disponible ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.disponibilidad_medicos.edit', $disponibilidad->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.disponibilidad_medicos.destroy', $disponibilidad->id) }}" method="POST" style="display:inline-block;">
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

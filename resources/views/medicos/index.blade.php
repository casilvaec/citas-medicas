@extends('adminlte::page')

@section('title', 'Gestión de Médicos')

@section('content_header')
    <h1>Gestión de Médicos</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('medicos.create') }}" class="btn btn-primary">Crear Nuevo Médico</a>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especialidades</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicos as $medico)
                    <tr>
                        <td>{{ $medico->id }}</td>
                        <td>{{ $medico->user->nombre }} {{ $medico->user->apellidos }}</td>
                        <td>
                            @foreach ($medico->especialidades as $especialidad)
                                {{ $especialidad->nombre }}
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('medicos.edit', $medico) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('medicos.destroy', $medico) }}" method="POST" style="display:inline;">
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
@stop

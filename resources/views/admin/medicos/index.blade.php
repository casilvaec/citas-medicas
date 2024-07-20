@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Médicos</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('admin.medicos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Médico</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
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
                              <span class="badge badge-info">{{ $especialidad->nombre }}</span>
                                
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.medicos.edit', $medico->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.medicos.destroy', $medico->id) }}" method="POST" style="display:inline;">
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

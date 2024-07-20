@extends('adminlte::page')

@section('title', 'Especialidades Médicas')

@section('content_header')
    <h1>Especialidades Médicas</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('admin.especialidades.create') }}" class="btn btn-primary mb-3">Crear Nueva Especialidad</a>
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
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($especialidades as $especialidad)
                    <tr>
                        <td>{{ $especialidad->id }}</td>
                        <td>{{ $especialidad->nombre }}</td>
                        <td>{{ $especialidad->descripcion }}</td>
                        <td>{{ $especialidad->estado ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            <a href="{{ route('admin.especialidades.edit', $especialidad->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.especialidades.destroy', $especialidad->id) }}" method="POST" style="display:inline;">
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

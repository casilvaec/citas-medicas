@extends('adminlte::page')

@section('title', 'Especialidades Médicas')

@section('content_header')
    <h1>Especialidades Médicas</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('especialidades.create') }}" class="btn btn-primary">Crear Nueva Especialidad</a>
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($especialidades as $especialidad)
                    <tr>
                        <td>{{ $especialidad->id }}</td>
                        <td>{{ $especialidad->nombre }}</td>
                        <td>{{ $especialidad->descripcion }}</td>
                        <td>
                            <a href="{{ route('especialidades.edit', $especialidad) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('especialidades.destroy', $especialidad) }}" method="POST" style="display:inline;">
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

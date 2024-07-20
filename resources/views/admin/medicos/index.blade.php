@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Gestión de Médicos</h1>
        <a href="{{ route('admin.medicos.create') }}" class="btn btn-primary mb-3">Agregar Médico</a>
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
                    <th>Apellidos</th>
                    <th>Especialidades</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicos as $medico)
                    <tr>
                        <td>{{ $medico->id }}</td>
                        <td>{{ $medico->user->nombre }}</td>
                        <td>{{ $medico->user->apellidos }}</td>
                        <td>{{ $medico->especialidades->pluck('nombre')->join(',') }}</td>
                        
                        <td>
                            <a href="{{ route('admin.medicos.edit', $medico->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.medicos.destroy', $medico->id) }}" method="POST" style="display:inline-block;">
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

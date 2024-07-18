@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ciudades de Residencia</h1>
    <a href="{{ route('admin.ciudades-residencia.create') }}" class="btn btn-primary">Agregar Ciudad de Residencia</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ciudadesResidencia as $ciudad)
                <tr>
                    <td>{{ $ciudad->id }}</td>
                    <td>{{ $ciudad->nombre }}</td>
                    <td>
                        <a href="{{ route('admin.ciudades-residencia.edit', $ciudad->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.ciudades-residencia.destroy', $ciudad->id) }}" method="POST" style="display:inline-block;">
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

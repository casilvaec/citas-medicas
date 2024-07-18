<!-- resources/views/catalogos/tipos_identificacion/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tipos de Identificación</h1>
    <a href="{{ route('admin.tipos-identificacion.create') }}" class="btn btn-primary">Agregar Tipo de Identificación</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiposIdentificacion as $tipo)
                <tr>
                    <td>{{ $tipo->id }}</td>
                    <td>{{ $tipo->tipo }}</td>
                    <td>
                        <a href="{{ route('admin.tipos-identificacion.edit', $tipo->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.tipos-identificacion.destroy', $tipo->id) }}" method="POST" style="display:inline-block;">
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




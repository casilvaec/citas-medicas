@extends('layouts.app')

@section('title', 'Gestión de Permisos')

@section('content')
@include('layouts.nav')

<div class="container">
    <h1 class="my-4">Gestión de Permisos</h1>
    <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Crear Permiso</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

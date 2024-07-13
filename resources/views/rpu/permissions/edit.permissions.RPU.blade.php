@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Permiso</h2>
    <!-- Formulario para editar un permiso existente -->
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Campo para el nombre del permiso -->
        <div class="form-group">
            <label for="name">Nombre del Permiso</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
        </div>
        <!-- Botón para actualizar el permiso -->
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection

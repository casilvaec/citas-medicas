@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Permiso</h2>
    <!-- Formulario para crear un nuevo permiso -->
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <!-- Campo para el nombre del permiso -->
        <div class="form-group">
            <label for="name">Nombre del Permiso</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <!-- Botón para guardar el nuevo permiso -->
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection

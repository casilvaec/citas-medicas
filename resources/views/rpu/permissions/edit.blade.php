@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Permiso</h2>
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre del Permiso</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción del Permiso</label>
            <textarea name="description" id="description" class="form-control">{{ $permission->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection

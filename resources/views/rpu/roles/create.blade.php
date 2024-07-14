@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Rol</h2>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Rol</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="permissions">Permisos</label>
            <div class="form-check">
                @foreach ($permissions as $permission)
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="perm-{{ $permission->id }}">
                    <label class="form-check-label" for="perm-{{ $permission->id }}">{{ $permission->name }}</label><br>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection


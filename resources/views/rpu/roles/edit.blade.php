{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Rol</h2>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre del Rol</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
        </div>
        <div class="form-group">
            <label for="permissions">Permisos</label>
            <div class="form-check">
                @foreach ($permissions as $permission)
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="perm-{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="perm-{{ $permission->id }}">{{ $permission->name }}</label><br>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Rol</h2>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre del Rol</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
        </div>
        <div class="form-group">
            <label for="permissions">Permisos</label>
            <div class="form-check">
                @foreach ($permissions as $permission)
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="perm-{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="perm-{{ $permission->id }}">{{ $permission->name }}</label><br>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection


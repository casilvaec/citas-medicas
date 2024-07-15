
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Usuario</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $user->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ $user->apellidos }}" required>
        </div>
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" id="correoElectronico" class="form-control" value="{{ $user->correoElectronico }}" required>
        </div>
        <div class="form-group">
            <label for="roles">Roles</label>
            <div class="form-check">
                @foreach ($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input" id="role-{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label><br>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection

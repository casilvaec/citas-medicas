@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Usuario</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
        </div>
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" id="correoElectronico" class="form-control" value="{{ old('correoElectronico') }}" required>
        </div>
        <div class="form-group">
            <label for="roles">Roles</label>
            <div class="form-check">
                @foreach ($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input" id="role-{{ $role->id }}">
                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label><br>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>
    <form method="post" action="{{ route('patient.profile.update') }}">
        @csrf
        <!-- Campos de datos personales -->
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label for="email">Correo:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
        </div>
        <!-- Otros campos -->
        <button type="submit">Guardar Cambios</button>
    </form>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light text-primary text-center py-3 mb-4 rounded">
        <h1 class="display-4">Editar Perfil</h1>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="post" action="{{ route('patient.profile.update') }}">
        @csrf
        <!-- Campos de datos personales -->
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $patient['name'] }}" required>
        </div>
        <div class="form-group">
            <label for="email">Correo:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $patient['email'] }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $patient['phone'] }}" required>
        </div>
        <div class="form-group">
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ $patient['address'] }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
        <a href="{{ route('patient.dashboard') }}" class="btn btn-secondary mt-3">Volver al Panel de Control</a>
    </form>
</div>
@endsection


@extends('layouts.app')

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
@endsection

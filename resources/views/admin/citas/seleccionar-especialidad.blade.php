@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seleccionar Especialidad Médica</h1>

    <!-- Mostrar el nombre del usuario si es necesario -->
    @if(isset($usuario_id))
        <p><strong>ID del Usuario:</strong> {{ $usuario_id }}</p>
    @endif

    <!-- Formulario para seleccionar una especialidad médica -->
    <form action="{{ route('admin.citas.medicos') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="especialidad_id">Especialidad Médica:</label>
            <select name="especialidad_id" id="especialidad_id" class="form-control" required>
                <option value="">Seleccione una especialidad</option>
                @foreach($especialidades as $id => $nombre)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pasamos el ID del usuario para el siguiente paso -->
        {{-- @if(isset($usuario_id))
            <input type="hidden" name="usuario_id" value="{{ $usuario_id }}">
        @endif --}}

        <!-- Campo oculto para enviar el ID del usuario -->
        <input type="hidden" name="usuario_id" value="{{ $usuario_id }}">

        <button type="submit" class="btn btn-primary">Seleccionar médico</button>
    </form>
</div>
@endsection


@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Agregar Nuevo Médico</h1>
        <form action="{{ route('admin.medicos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Usuario</label>
                <select name="user_id" id="user_id" class="form-control"  required>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="especialidades">Especialidades</label>
                <select name="especialidades[]" id="especialidades" class="form-control"  multiple>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            
        </form>
    </div>
@endsection

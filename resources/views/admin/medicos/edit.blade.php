@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Editar Médico</h1>
        <form action="{{ route('admin.medicos.update', $medico->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">Usuario</label>
                <select name="usuarioId" id="usuarioId"class="form-control"  required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $usuario->id == $medico->usuarioId ? 'selected' : '' }}>
                            {{ $usuario->nombre }} {{ $usuario->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="especialidades">Especialidades</label>
                <select name="especialidades[]" id="especialidades" class="form-control"  multiple required>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}" {{ in_array($especialidad->id, $medico->especialidades->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $especialidad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            
        </form>
    </div>
@endsection

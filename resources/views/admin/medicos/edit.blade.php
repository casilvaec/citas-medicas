{{-- @extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Editar Médico</h1>
        <form action="{{ route('admin.medicos.update', $medico->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="usuarioId">Usuario</label>
                <select name="usuarioId" id="usuarioId" class="form-control select2">
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $usuario->id == $medico->usuarioId ? 'selected' : '' }}>
                            {{ $usuario->nombre }} {{ $usuario->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="especialidades">Especialidades</label>
                <select name="especialidades[]" id="especialidades" class="form-control select2"  multiple>
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

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar asignación</h1>
        <form action="{{ route('admin.medicos.update', $medico->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="usuario">Médico</label>
                <input type="text" class="form-control" id="usuario" value="{{ $medico->user->nombre }} {{ $medico->user->apellidos }}" disabled>
                <input type="hidden" name="usuarioId" value="{{ $medico->usuarioId }}">
            </div>

            <div class="form-group">
                <label for="especialidades">Especialidades</label>
                <div>
                    @foreach ($especialidades as $especialidad)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="especialidades[]" value="{{ $especialidad->id }}"
                                   {{ $medico->especialidades->contains($especialidad->id) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $especialidad->nombre }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection

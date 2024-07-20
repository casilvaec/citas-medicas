@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Agregar Nuevo Médico</h1>
        <form action="{{ route('admin.medicos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="usuarioId">Usuario</label>
                <select name="usuarioId" id="usuarioId" class="form-control select2">
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }} {{ $usuario->apellidos }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="especialidades">Especialidades</label>
                <select name="especialidades[]" id="especialidades" class="form-control select2"  multiple>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            
        </form>
    </div>

    
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    
@endpush
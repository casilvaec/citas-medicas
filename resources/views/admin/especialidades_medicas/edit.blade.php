@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Editar Especialidad Médica</h1>
        <form action="{{ route('admin.especialidades.update', $especialidad->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"  value="{{ $especialidad->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" >{{ $especialidad->descripcion }}</textarea>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="1" {{ $especialidad->estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $especialidad->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            
        </form>
    </div>
@endsection

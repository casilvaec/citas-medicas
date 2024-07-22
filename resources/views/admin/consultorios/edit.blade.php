@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Consultorio</h1>
    <form action="{{ route('admin.consultorios.update', $consultorio->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $consultorio->codigo }}" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $consultorio->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $consultorio->descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ $consultorio->ubicacion }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

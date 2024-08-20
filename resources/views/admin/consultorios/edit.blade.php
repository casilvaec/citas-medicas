@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Consultorio</h1>

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.consultorios.update', $consultorio->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $consultorio->codigo) }}" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $consultorio->nombre) }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $consultorio->descripcion) }}</textarea>
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion', $consultorio->ubicacion) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

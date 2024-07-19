@extends('adminlte::page')

@section('title', 'Crear Especialidad Médica')

@section('content_header')
    <h1>Crear Especialidad Médica</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('especialidades.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('especialidades.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@stop

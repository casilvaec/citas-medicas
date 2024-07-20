@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Agregar Nueva Especialidad Médica</h1>
        <form action="{{ route('admin.especialidades.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            
        </form>
    </div>
@endsection

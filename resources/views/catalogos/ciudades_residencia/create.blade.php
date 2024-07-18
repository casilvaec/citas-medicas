@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Ciudad de Residencia</h1>
        <form action="{{ route('admin.ciudades-residencia.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection



@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Ciudad de Residencia</h1>
        <form action="{{ route('admin.ciudades-residencia.update', ['ciudad' => $ciudad->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $ciudad->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection


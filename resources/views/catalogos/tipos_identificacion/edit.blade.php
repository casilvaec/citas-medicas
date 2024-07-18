<!-- resources/views/catalogos/tipos_identificacion/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Tipo de Identificación</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.tipos-identificacion.update', ['tipos_identificacion' => $tipoIdentificacion->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" id="tipo" class="form-control" value="{{ $tipoIdentificacion->tipo }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Género</h1>
    <div class="card">
        <div class="card-header">
            Género
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $genero->nombre }}</h5>
            <p class="card-text">Creado el: {{ $genero->created_at }}</p>
            <p class="card-text">Actualizado el: {{ $genero->updated_at }}</p>
            <a href="{{ route('admin.generos.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection

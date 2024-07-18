@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Tipo de Identificación</h1>
    <div class="card">
        <div class="card-header">
            Tipo de Identificación
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $tipoIdentificacion->tipo }}</h5>
            <p class="card-text">Creado el: {{ $tipoIdentificacion->created_at }}</p>
            <p class="card-text">Actualizado el: {{ $tipoIdentificacion->updated_at }}</p>
            <a href="{{ route('admin.tipos-identificacion.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la Ciudad de Residencia</h1>
    <div class="card">
        <div class="card-header">
            Ciudad de Residencia
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $ciudadResidencia->nombre }}</h5>
            <p class="card-text">Creado el: {{ $ciudadResidencia->created_at }}</p>
            <p class="card-text">Actualizado el: {{ $ciudadResidencia->updated_at }}</p>
            <a href="{{ route('admin.ciudades-residencia.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial Médico de {{ $paciente->nombre }} {{ $paciente->apellido }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Diagnóstico</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historial as $registro)
            <tr>
                <td>{{ $registro->fecha }}</td>
                <td>{{ $registro->descripcion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

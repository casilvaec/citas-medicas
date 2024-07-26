@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Atención al Paciente</h1>
    <form action="{{ route('medico.registrarAtencion') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control">
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="diagnostico">Diagnóstico</label>
            <textarea name="diagnostico" id="diagnostico" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Atención</button>
    </form>
</div>
@endsection

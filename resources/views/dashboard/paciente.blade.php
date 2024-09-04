@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel del Paciente</h1>
    
    <!-- Mostrar el nombre completo y el rol del usuario -->
    <p>Bienvenido(a), {{ $nombre }} {{ $apellido }}.</p>
    <p>Tu rol es: {{ $rol }}</p>

    <!-- Botones de acciones que puede realizar el paciente -->
    
        <a href="{{ url('/admin/citas/agendar') }}" class="btn btn-primary">Agendar Cita</a>
        {{-- <a href="{{ url('/admin/citas/cancel') }}" class="btn btn-secondary">Cancelar Cita</a> --}}
        <a href="{{ url('/profile/edit') }}" class="btn btn-info">Ver Perfil Personal</a>
    
</div>
@endsection

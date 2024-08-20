{{-- resources/views/admin/consultorio_medico/create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignar Consultorio a Médico</h1>

    <form action="{{ route('admin.consultorio_medico.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="consultorio_id">Consultorio</label>
            <select name="consultorio_id" id="consultorio_id" class="form-control" required>
                <option value="">Seleccione un consultorio</option>
                {{-- @foreach($consultorios as $id => $nombre)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach --}}
                @foreach($consultorios as $id => $consultorio)
                    <option value="{{ $id }}">{{ $consultorio['codigo'] }} - {{ $consultorio['nombre'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="medico_id">Médico</label>
            <select name="medico_id" id="medico_id" class="form-control" required>
                <option value="">Seleccione un médico</option>
                @foreach($medicos as $id => $nombre)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo de fecha oculto -->
        <input type="hidden" name="fecha_asignacion" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        
        {{-- <div class="form-group">
            <label for="fecha_asignacion">Fecha de Asignación</label>
            <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control" required>
        </div> --}}

        <button type="submit" class="btn btn-primary">Asignar</button>
    </form>
</div>
@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush


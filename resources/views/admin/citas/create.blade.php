@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agendar Nueva Cita</h1>
    <form action="{{ route('admin.citas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control">
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellidos }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="especialidad_id">Especialidad</label>
            <select name="especialidad_id" id="especialidad_id" class="form-control">
                @foreach($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="medico_id">Médico</label>
            <select name="medico_id" id="medico_id" class="form-control">
                <!-- Lógica para listar médicos -->
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control">
        </div>
        <div class="form-group">
            <label for="hora_inicio">Hora de Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control">
        </div>
        <div class="form-group">
            <label for="hora_fin">Hora de Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control">
        </div>
        <div class="form-group">
            <label for="motivo">Motivo</label>
            <input type="text" name="motivo" id="motivo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Agendar Cita</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
        

        $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });

    $(document).ready(function() {
        $('#especialidad_id').on('change', function() {
            var especialidadId = $(this).val();
            if (especialidadId) {
                $.ajax({
                    url: '{{ route("admin.citas.fetch_medicos") }}',
                    type: 'GET',
                    data: { especialidad_id: especialidadId },
                    success: function(data) {
                        $('#medico_id').html(data);
                        $('#medico_id').trigger('change'); // Recargar select2
                    }
                });
            } else {
                $('#medico_id').html('<option value="">Seleccione un médico</option>');
            }
        });
    });
</script>
@endpush

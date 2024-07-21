@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Asignar Horario Médico</h2>

    <form action="{{ route('admin.horarios_medicos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="medico">Médico</label>
            <select class="form-control select2" id="medico" name="medicoId">
                <option value="">Seleccione un médico</option>
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id }}">{{ $medico->nombre }} {{ $medico->apellido }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="text" class="form-control datepicker" id="fecha_inicio" name="fecha_inicio">
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="text" class="form-control datepicker" id="fecha_fin" name="fecha_fin">
        </div>

        <div class="form-group">
            <label for="hora_inicio">Hora de Inicio</label>
            <input type="text" class="form-control timepicker" id="hora_inicio" name="hora_inicio">
        </div>

        <div class="form-group">
            <label for="hora_fin">Hora de Fin</label>
            <input type="text" class="form-control timepicker" id="hora_fin" name="hora_fin">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione un médico",
            allowClear: true
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+0d',
            daysOfWeekDisabled: [0, 6]
        });

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '09:00',
            maxTime: '18:00',
            defaultTime: '09:00',
            startTime: '09:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
@endpush

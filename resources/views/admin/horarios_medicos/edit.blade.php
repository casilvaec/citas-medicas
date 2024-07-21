@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Horario Médico</h1>
    <form action="{{ route('admin.horarios_medicos.update', $horario->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="medicoId">Médico</label>
            <select id="medicoId" name="medicoId" class="form-control select2">
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id }}" {{ $horario->medico->id == $medico->id ? 'selected' : '' }}>
                        {{ $medico->identificacion }} - {{ $medico->nombre }} {{ $medico->apellido }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="text" id="fecha" name="fecha" class="form-control datepicker" value="{{ $horario->fecha }}">
        </div>
        <div class="form-group">
            <label for="horaInicio">Hora de Inicio</label>
            <select id="horaInicio" name="horaInicio" class="form-control">
                <option value="09:00" {{ $horario->horaInicio == '09:00' ? 'selected' : '' }}>09:00</option>
                <option value="09:30" {{ $horario->horaInicio == '09:30' ? 'selected' : '' }}>09:30</option>
                <option value="10:00" {{ $horario->horaInicio == '10:00' ? 'selected' : '' }}>10:00</option>
                <option value="10:30" {{ $horario->horaInicio == '10:30' ? 'selected' : '' }}>10:30</option>
                <option value="11:00" {{ $horario->horaInicio == '11:00' ? 'selected' : '' }}>11:00</option>
                <option value="11:30" {{ $horario->horaInicio == '11:30' ? 'selected' : '' }}>11:30</option>
                <option value="16:00" {{ $horario->horaInicio == '16:00' ? 'selected' : '' }}>16:00</option>
                <option value="16:30" {{ $horario->horaInicio == '16:30' ? 'selected' : '' }}>16:30</option>
                <option value="17:00" {{ $horario->horaInicio == '17:00' ? 'selected' : '' }}>17:00</option>
                <option value="17:30" {{ $horario->horaInicio == '17:30' ? 'selected' : '' }}>17:30</option>
            </select>
        </div>
        <div class="form-group">
            <label for="horaFin">Hora de Fin</label>
            <select id="horaFin" name="horaFin" class="form-control">
                <option value="09:30" {{ $horario->horaFin == '09:30' ? 'selected' : '' }}>09:30</option>
                <option value="10:00" {{ $horario->horaFin == '10:00' ? 'selected' : '' }}>10:00</option>
                <option value="10:30" {{ $horario->horaFin == '10:30' ? 'selected' : '' }}>10:30</option>
                <option value="11:00" {{ $horario->horaFin == '11:00' ? 'selected' : '' }}>11:00</option>
                <option value="11:30" {{ $horario->horaFin == '11:30' ? 'selected' : '' }}>11:30</option>
                <option value="12:00" {{ $horario->horaFin == '12:00' ? 'selected' : '' }}>12:00</option>
                <option value="16:30" {{ $horario->horaFin == '16:30' ? 'selected' : '' }}>16:30</option>
                <option value="17:00" {{ $horario->horaFin == '17:00' ? 'selected' : '' }}>17:00</option>
                <option value="17:30" {{ $horario->horaFin == '17:30' ? 'selected' : '' }}>17:30</option>
                <option value="18:00" {{ $horario->horaFin == '18:00' ? 'selected' : '' }}>18:00</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione un médico",
            allowClear: true,
            ajax: {
                url: '{{ route("admin.medicos.search") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.identificacion + ' - ' + item.nombre + ' ' + item.apellido,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
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
@endsection
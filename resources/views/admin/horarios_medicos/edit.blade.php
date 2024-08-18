{{-- @extends('layouts.app')

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
@endsection --}}


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Horario Médico</h1>
    <form action="{{ route('admin.horarios_medicos.update', $horarioMedico->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="medicoId">Médico</label>
            <select id="medicoId" name="medicoId" class="form-control select2">
                @foreach($medicos as $id => $full_name)
                    <option value="{{ $id }}" {{ $horarioMedico->medicoId == $id ? 'selected' : '' }}>
                        {{ $full_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="text" id="fecha" name="fecha" class="form-control" value="{{ $horarioMedico->fecha }}" readonly>
        </div>
        <div class="form-group">
            <label for="horarios">Seleccione el horario</label>
            <div class="checkbox">
                <labe>><input type="checkbox" name="horarios[]" value="1" {{ $horarioMedico->horaInicio == '09:00:00' && $horarioMedico->horaFin == '12:00:00' ? 'checked' : '' }}>09:00 - 12:00</labe>
            </div>
            <div class="checkbox">
                <labe>><input type="checkbox" name="horarios[]" value="2" {{ $horarioMedico->horaInicio == '16:00:00' && $horarioMedico->horaFin == '18:00:00' ? 'checked' : '' }}>16:00 - 18:00</labe>
            </div>
            {{-- <label for="horaInicio">Hora de Inicio</label>
            <select id="horaInicio" name="horaInicio" class="form-control">
                <option value="09:00:00" {{ $horarioMedico->horaInicio == '09:00:00' ? 'selected' : '' }}>09:00</option>
                <option value="16:00:00" {{ $horarioMedico->horaInicio == '16:00:00' ? 'selected' : '' }}>16:00</option>
            </select>
        </div>
        <div class="form-group">
            <label for="horaFin">Hora de Fin</label>
            <select id="horaFin" name="horaFin" class="form-control">
                <option value="12:00:00" {{ $horarioMedico->horaFin == '12:00:00' ? 'selected' : '' }}>12:00</option>
                <option value="18:00:00" {{ $horarioMedico->horaFin == '18:00:00' ? 'selected' : '' }}>18:00</option>
            </select> --}}
        {{-- </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#medicoId').select2({
            placeholder: "Seleccione un médico",
        });

        $('.select2').select2();
    });
</script>
@endpush --}}
{{-- @endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Horario Médico</h1>
    <form action="{{ route('admin.horarios_medicos.update', $horarioMedico->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Mostrar el nombre del médico, sin permitir cambios -->
        <div class="form-group">
            <label for="medico">Médico</label>
            <input type="text" class="form-control" id="medico" value="{{ $horarioMedico->medico->user->nombre }} {{ $horarioMedico->medico->user->apellidos }}" disabled>
        </div>
        
        <!-- Mostrar solo el horario que está siendo editado -->
        <div class="form-group">
            <label for="horario">Horario Asignado</label>
            @if($horarioMedico->horaInicio == '09:00:00' && $horarioMedico->horaFin == '12:00:00')
                <div>
                    <input type="checkbox" id="horario1" name="horario" value="1" checked>
                    <label for="horario1">09:00 - 12:00</label>
                </div>
            @elseif($horarioMedico->horaInicio == '16:00:00' && $horarioMedico->horaFin == '18:00:00')
                <div>
                    <input type="checkbox" id="horario2" name="horario" value="2" checked>
                    <label for="horario2">16:00 - 18:00</label>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection


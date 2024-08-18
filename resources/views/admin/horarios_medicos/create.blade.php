{{-- @extends('layouts.app')

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
            <label for="fecha">Fecha</label>
            <input type="text" class="form-control datepicker" id="fecha" name="fecha">
        </div>

        <div class="form-group">
            <label>Seleccione el Horario</label>
            <div>
                <input type="checkbox" id="horario_morning" name="horarios[]" value="09:00-12:00">
                <label for="horario_morning">09:00 - 12:00</label>
            </div>
            <div>
                <input type="checkbox" id="horario_afternoon" name="horarios[]" value="16:00-18:00">
                <label for="horario_afternoon">16:00 - 18:00</label>
            </div>
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
            startDate: '-0d',
            autoclose: true,
            daysOfWeekDisabled: [0, 6] // Deshabilitar sábados y domingos
        });
    });
</script>
@endpush --}}

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignar Horario Médico</h1>
    <form action="{{ route('admin.horarios_medicos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="medico">Médico</label>
            <select class="form-control select2" name="medicoId" id="medicoId">
                <option value="">Seleccione un médico</option>
                @foreach($medicos as $id => $full_name)
                    <option value="{{ $id }}">{{ $full_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="text" class="form-control datepicker" name="fecha" id="fecha" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="horario">Seleccione el Horario</label><br>
            <input type="checkbox" name="horarios[]" value="1"> 09:00 - 12:00<br>
            <input type="checkbox" name="horarios[]" value="2"> 16:00 - 18:00<br>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $(#medicoId).select2({
            placeholder: "Seleccione un médico",
            //allowClear: true
        });
        $('#fecha').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            beforeShowDay: $.datepicker.noWeekends
        });
        $('.select2').select2();
    });
</script>
@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Asignar Horario Médico</h1>
        <form action="{{ route('admin.horarios_medicos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="medicoId">Médico</label>
                <select name="medicoId" id="medicoId" class="form-control select2">
                    <option value="">Seleccione un médico</option>
                    @foreach($medicos as $id => $full_name)
                        <option value="{{ $id }}">{{ $full_name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="text" name="fecha" id="fecha" class="form-control datepicker">
            </div> --}}
            <div class="form-group">
                <label for="horarios">Seleccione el Horario</label>
                <div class="checkbox">
                    <label><input type="checkbox" name="horarios[]" value="1"> 09:00 - 12:00</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="horarios[]" value="2"> 16:00 - 18:00</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Asignar</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#medicoId').select2({
                placeholder: "Seleccione un médico",
                //allowClear: true
            });

            //$('#fecha').datepicker({
                //dateformat: 'yy-mm-dd',
                //autoclose: true,
                //minDate: 0,
                //beforeShowDay: $.datepicker.noWeekends
            //});

            $('.select2').select2();
        });
    </script>
@endpush

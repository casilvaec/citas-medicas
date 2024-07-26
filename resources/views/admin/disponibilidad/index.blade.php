{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Disponibilidad de Médicos</h1>
    <a href="{{ route('admin.disponibilidad_medicos.create') }}" class="btn btn-primary mb-3">Agregar Disponibilidad</a>
    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
    {{-- <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Disponible</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disponibilidades as $disponibilidad)
            <tr>
                <td>{{ $disponibilidad->id }}</td>
                <td>{{ $disponibilidad->medico->nombre }} {{ $disponibilidad->medico->apellido }}</td>
                <td>{{ $disponibilidad->fecha }}</td>
                <td>{{ $disponibilidad->horaInicio }}</td>
                <td>{{ $disponibilidad->horaFin }}</td>
                <td>{{ $disponibilidad->disponible ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.disponibilidad_medicos.edit', $disponibilidad->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.disponibilidad_medicos.destroy', $disponibilidad->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}
{{-- @endsection --}} 

 {{-- resources/views/admin/disponibilidad/index.blade.php --}}




 {{-- ANTES FUNCIONABA ESTE DE AQUI PARA ABAJO --}}

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Disponibilidad de Médicos</h2>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disponibilidades as $disponibilidad)
            <tr>
                <td>{{ $disponibilidad->id }}</td>
                <td>{{ $disponibilidad->medico->user->nombre }} {{ $disponibilidad->medico->user->apellidos }}</td>
                <td>{{ $disponibilidad->fecha }}</td>
                <td>{{ $disponibilidad->horaInicio }}</td>
                <td>{{ $disponibilidad->horaFin }}</td>
                <td>
                    <span class="badge {{ $disponibilidad->disponible ? 'bg-success' : 'bg-danger' }}">
                        {{ $disponibilidad->disponible ? 'Disponible' : 'Reservado' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Disponibilidad de Médicos</h1>

    <!-- Selector de Doctor -->
    <div class="form-group">
        <label for="medicoId">Seleccionar Doctor</label>
        <select name="medicoId" id="medicoId" class="form-control select2">
            <option value="">Seleccione un médico</option>
            @foreach($medicos as $id => $full_name)
                <option value="{{ $id }}">{{ $full_name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Selector de Fecha -->
    <div class="form-group">
        <label for="fecha">Seleccionar Fecha</label>
        <input type="text" id="fecha" name="fecha" class="form-control datepicker">
    </div>

    <!-- Tabla de Disponibilidad -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody id="disponibilidadBody">
            <!-- Aquí se cargarán los datos de disponibilidad -->
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#medicoId').select2({
            placeholder: "Seleccione un médico",
        });

        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
        });

        $('#medicoId, #fecha').on('change', function() {
            var medicoId = $('#medicoId').val();
            var fecha = $('#fecha').val();
            if (medicoId && fecha) {
                $.ajax({
                    url: '{{ route("admin.disponibilidad.fetch") }}',
                    type: 'GET',
                    data: { medicoId: medicoId, fecha: fecha },
                    success: function(data) {
                        $('#disponibilidadBody').html(data);
                    }
                });
            } else {
                $('#disponibilidadBody').html('');
            }
        });
    });
</script>
@endpush

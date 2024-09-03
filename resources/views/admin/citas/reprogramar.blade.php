@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Selecciona Nueva Fecha y Horario para la Cita</h2>
    
    <form action="{{ route('admin.citas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fecha" class="form-label">Selecciona una Fecha Disponible:</label>
            <select class="form-control" id="fecha" name="fecha" required>
                <option value="">-- Selecciona Fecha --</option>
                @foreach ($disponibilidades->unique('fecha') as $disponibilidad)
                    <option value="{{ $disponibilidad->fecha }}">
                        {{ \Carbon\Carbon::parse($disponibilidad->fecha)->format('d-M-Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="horario" class="form-label">Selecciona un Horario Disponible:</label>
            <select class="form-control" id="horario" name="horario" required>
                <!-- Este se llenará con JavaScript al seleccionar una fecha -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Reprogramar Cita</button>
    </form>
</div>

<script>
    document.getElementById('fecha').addEventListener('change', function() {
        const fechaSeleccionada = this.value;
        const horariosSelect = document.getElementById('horario');
        horariosSelect.innerHTML = ''; // Limpiar horarios anteriores

        @foreach ($disponibilidades as $disponibilidad)
            if ('{{ $disponibilidad->fecha }}' === fechaSeleccionada) {
                const option = document.createElement('option');
                option.value = '{{ $disponibilidad->horaInicio }} - {{ $disponibilidad->horaFin }}';
                option.textContent = '{{ $disponibilidad->horaInicio }} - {{ $disponibilidad->horaFin }}';
                horariosSelect.appendChild(option);
            }
        @endforeach
    });
</script>

@endsection

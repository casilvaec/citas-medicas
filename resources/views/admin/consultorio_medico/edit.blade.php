@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Asignación de Consultorio a Médico</h1>

    <form action="{{ route('admin.consultorio_medico.update', $consultorioMedico->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo consultorio: Solo para mostrar, no editable -->
        <div class="form-group">
          <label for="consultorio_id">Consultorio</label>
          <input type="text" class="form-control" value="{{ $consultorioMedico->consultorio->codigo }} - {{ $consultorioMedico->consultorio->nombre }}" disabled>
          <input type="hidden" name="consultorio_id" value="{{ $consultorioMedico->consultorio_id }}">
        </div>

        <!-- Campo médico: Editable -->
        <div class="form-group">
          <label for="medico_id">Médico</label>
          <select name="medico_id" id="medico_id" class="form-control" required>
              <option value="">Seleccione un médico</option>
              @foreach($medicos as $id => $nombre)
                  <option value="{{ $id }}" {{ $consultorioMedico->medico_id == $id ? 'selected' : '' }}>
                      {{ $nombre }}
                  </option>
              @endforeach
          </select>
        </div>

        <!-- Fecha de asignación no es editable -->
        <!-- Campo de fecha oculto: Fecha de asignación (actualizada automáticamente) -->
        <input type="hidden" name="fecha_asignacion" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

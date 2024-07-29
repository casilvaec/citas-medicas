<!-- resources/views/admin/citas/partials/disponibilidad.blade.php -->

{{-- @foreach($disponibilidades as $disponibilidad)
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
@endforeach --}}

<!-- resources/views/admin/citas/partials/disponibilidad.blade.php -->

<table class="table table-bordered">
  <thead>
      <tr>
          <th>ID</th>
          <th>Médico</th>
          <th>Fecha</th>
          <th>Hora de Inicio</th>
          <th>Hora de Fin</th>
          <th>Estado</th>
          <th>Seleccionar</th>
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
          <td>
              @if($disponibilidad->disponible)
                  <button type="button" class="btn btn-primary seleccionar-disponibilidad" data-id="{{ $disponibilidad->id }}" data-fecha="{{ $disponibilidad->fecha }}" data-inicio="{{ $disponibilidad->horaInicio }}" data-fin="{{ $disponibilidad->horaFin }}">
                      Seleccionar
                  </button>
              @else
                  No disponible
              @endif
          </td>
      </tr>
      @endforeach
  </tbody>
</table>


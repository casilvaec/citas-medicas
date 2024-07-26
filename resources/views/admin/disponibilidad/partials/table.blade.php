<!-- resources/views/admin/disponibilidad/partials/table.blade.php -->

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

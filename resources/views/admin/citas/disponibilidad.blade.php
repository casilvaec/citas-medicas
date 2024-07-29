// resources/views/admin/citas/disponibilidad.blade.php

<table class="table table-bordered">
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
                @if($disponibilidad->disponible)
                    <span class="badge badge-success">Disponible</span>
                @else
                    <span class="badge badge-danger">No Disponible</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

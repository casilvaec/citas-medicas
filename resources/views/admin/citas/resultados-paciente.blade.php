@if($pacientes->isEmpty())
    <div class="alert alert-danger">
        No se encontraron pacientes que coincidan con los criterios de búsqueda.
    </div>
@else
    <h3>Seleccione un Paciente:</h3>
    <ul class="list-group">
        @foreach($pacientes as $paciente)
            <li class="list-group-item">
                <a href="{{ route('admin.citas.seleccionarPaciente', $paciente->id) }}">
                    {{ $paciente->nombre }} {{ $paciente->apellidos }} - {{ $paciente->numero_identificacion }}
                </a>
            </li>
        @endforeach
    </ul>
@endif

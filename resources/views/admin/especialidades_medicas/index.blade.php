@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Especialidades Médicas</h1>
        <a href="{{ route('admin.especialidades.create') }}" class="btn btn-primary mb-3">Agregar Especialidad</a>
       
        <table id="especialidades-table" class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($especialidades as $especialidad)
                    <tr>
                        <td>{{ $especialidad->id }}</td>
                        <td>{{ $especialidad->nombre }}</td>
                        <td>{{ $especialidad->descripcion }}</td>
                        <td>{{ $especialidad->estado ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            <a href="{{ route('admin.especialidades.edit', $especialidad->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.especialidades.destroy', $especialidad->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<!-- Modificación: Añadir el script para inicializar DataTables -->
@push('scripts')
<script>
    $(document).ready(function() {
        $('#especialidades-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush
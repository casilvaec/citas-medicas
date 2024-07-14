{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Permisos</h2>
    <!-- Botón para crear un nuevo permiso -->
    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Crear Permiso</a>
    <table id="permissions-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td> <!-- Muestra el ID del permiso -->
                    <td>{{ $permission->name }}</td> <!-- Muestra el nombre del permiso -->
                    <td>
                        <!-- Botón para editar el permiso -->
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Editar</a>
                        <!-- Formulario para eliminar el permiso -->
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button> <!-- Botón para eliminar el permiso -->
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#permissions-table').DataTable(); // Inicializa DataTables en la tabla de permisos
    });
</script>
@endpush --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="font-weight-bold">Gestión de Permisos</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('permissions.create') }}" class="btn btn-primary">Crear Permiso</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="permissions-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion del Permiso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
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
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#permissions-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Consultorios</h1>
    <a href="{{ route('admin.consultorios.create') }}" class="btn btn-primary">Agregar Consultorio</a>
    <table id="consultorios-table"class="table mt-3">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultorios as $consultorio)
                <tr>
                    <td>{{ $consultorio->codigo }}</td>
                    <td>{{ $consultorio->nombre }}</td>
                    <td>{{ $consultorio->descripcion }}</td>
                    <td>{{ $consultorio->ubicacion }}</td>
                    <td>{{ $consultorio->estado }}</td>
                    <td>
                        <a href="{{ route('admin.consultorios.edit', $consultorio->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.consultorios.destroy', $consultorio->id) }}" method="POST" style="display:inline-block;">
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

<!-- script para inicializar DataTables -->
@push('scripts')
<script>
    $(document).ready(function() {
        $('#consultorios-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush
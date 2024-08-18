<!-- resources/views/catalogos/ciudades_residencia/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ciudades de Residencia</h1>
        <a href="{{ route('admin.ciudades-residencia.create') }}" class="btn btn-primary mb-3">Agregar Ciudad de Residencia</a>
        <table id="ciudades-residencia-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ciudades as $ciudad)
                    <tr>
                        <td>{{ $ciudad->id }}</td>
                        <td>{{ $ciudad->nombre }}</td>
                        <td>
                            <a href="{{ route('admin.ciudades-residencia.edit', $ciudad->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.ciudades-residencia.destroy', $ciudad->id) }}" method="POST" style="display:inline-block;">
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
        $('#ciudades-residencia-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush
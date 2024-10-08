<!-- resources/views/catalogos/generos/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Géneros</h1>
    <a href="{{ route('admin.generos.create') }}" class="btn btn-primary">Agregar Género</a>

    <table id="generos-table" class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($generos as $genero)
                <tr>
                    <td>{{ $genero->id }}</td>
                    <td>{{ $genero->nombre }}</td>
                    <td>
                        <a href="{{ route('admin.generos.edit', $genero->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.generos.destroy', $genero->id) }}" method="POST" style="display:inline-block;">
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
        $('#generos-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });
</script>
@endpush
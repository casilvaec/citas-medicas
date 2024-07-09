@extends('layouts.app')

@section('title', 'Editar Permiso')

@section('content')
@include('layouts.nav')

<div class="container">
    <h1 class="my-4">Editar Permiso</h1>
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Permiso</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

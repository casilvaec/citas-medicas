@extends('layouts.app')

@section('title', 'Crear Permiso')

@section('content')
@include('layouts.nav')

<div class="container">
    <h1 class="my-4">Crear Permiso</h1>
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Permiso</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

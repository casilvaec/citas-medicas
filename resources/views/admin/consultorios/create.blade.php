{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Consultorio</h1>
    <form action="{{ route('admin.consultorios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id
            <input type="text" name="codigo" id="codigo" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
          </div>
          <div class="form-group">
              <label for="ubicacion">Ubicación</label>
              <input type="text" name="ubicacion" id="ubicacion" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
  </div>
  @endsection --}}
  

  @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Consultorio</h1>
    <form action="{{ route('admin.consultorios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control" required>
        </div>
        <div class="form-group" style="display: none;">
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" class="form-control" value="Disponible" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

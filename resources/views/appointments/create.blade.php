<!DOCTYPE html>
<html>
<head>
    <title>Crear Nueva Cita</title>
</head>
<body>
    <h1>Crear Nueva Cita</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <label for="title">Título:</label>
        <input type="text" name="title" id="title">
        
        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date">

        <button type="submit">Guardar</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Citas</title>
</head>
<body>
    <h1>Lista de Citas</h1>
    <a href="{{ route('appointments.create') }}">Crear Nueva Cita</a>

    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif

    <!-- Aquí puedes listar tus citas si las tienes -->
    @if(count($appointments) > 0)
        <ul>
            @foreach($appointments as $appointment)
                <li>{{ $appointment->title }} - {{ $appointment->date }}</li>
            @endforeach
        </ul>
    @else
        <p>No hay citas disponibles.</p>
    @endif
</body>
</html>


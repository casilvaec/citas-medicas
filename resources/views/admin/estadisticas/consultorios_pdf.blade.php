<!DOCTYPE html>
<html>
<head>
    <title>Consultorios Report</title>
    <style>
        /* Aquí puedes agregar estilos personalizados para el PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Consultorios</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Médico</th>
                <th>Especialidad</th>
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
                <td>{{ $consultorio->medico->user->name }}</td>
                <td>{{ $consultorio->medico->especialidad->nombre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

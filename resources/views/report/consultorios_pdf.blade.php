<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Consultorios</title>
    <style>
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
    </style>
</head>
<body>
    <h1>Reporte de Consultorios</h1>
    <table>
        <thead>
            <tr>
                <th>Consultorio</th>
                <th>Doctor</th>
                <th>Especialidad</th>
                <th>Fecha de Asignación</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultorios as $consultorio)
                <tr>
                    <td>{{ $consultorio->nombre }}</td>
                    <td>{{ $consultorio->medico ? $consultorio->medico->user->nombre . ' ' . $consultorio->medico->user->apellidos : '' }}</td>
                    <td>{{ $consultorio->medico && $consultorio->medico->especialidad ? $consultorio->medico->especialidad->nombre : '' }}</td>
                    <td>{{ $consultorio->fecha_asignacion }}</td>
                    <td>{{ $consultorio->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de empleados</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de empleados</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('nombre') }}</th>
                <td>{{ $item->nombre }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('puesto') }}</th>
                <td>{{ $item->puesto }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('salario') }}</th>
                <td>{{ $item->salario }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('not') }}</th>
                <td>{{ $item->not }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
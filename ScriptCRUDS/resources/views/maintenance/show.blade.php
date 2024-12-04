<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de maintenance</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de maintenance</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('car_id') }}</th>
                <td>{{ $item->car_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('employee_id') }}</th>
                <td>{{ $item->employee_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('description') }}</th>
                <td>{{ $item->description }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('date') }}</th>
                <td>{{ $item->date }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('cost') }}</th>
                <td>{{ $item->cost }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('not') }}</th>
                <td>{{ $item->not }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
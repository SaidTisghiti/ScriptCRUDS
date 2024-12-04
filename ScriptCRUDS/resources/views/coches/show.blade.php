<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de coches</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de coches</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('marca') }}</th>
                <td>{{ $item->marca }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('modelo') }}</th>
                <td>{{ $item->modelo }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('o') }}</th>
                <td>{{ $item->o }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('precio') }}</th>
                <td>{{ $item->precio }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('not') }}</th>
                <td>{{ $item->not }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('color') }}</th>
                <td>{{ $item->color }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('stock') }}</th>
                <td>{{ $item->stock }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('coches.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
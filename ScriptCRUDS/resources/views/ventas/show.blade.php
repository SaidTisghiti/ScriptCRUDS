<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de ventas</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de ventas</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('coche_id') }}</th>
                <td>{{ $item->coche_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('cliente_id') }}</th>
                <td>{{ $item->cliente_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('empleado_id') }}</th>
                <td>{{ $item->empleado_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('fecha') }}</th>
                <td>{{ $item->fecha }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('cantidad') }}</th>
                <td>{{ $item->cantidad }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('total') }}</th>
                <td>{{ $item->total }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('not') }}</th>
                <td>{{ $item->not }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
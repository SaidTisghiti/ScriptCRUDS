<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de customers</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de customers</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('name') }}</th>
                <td>{{ $item->name }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('email') }}</th>
                <td>{{ $item->email }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('phone') }}</th>
                <td>{{ $item->phone }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('address') }}</th>
                <td>{{ $item->address }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
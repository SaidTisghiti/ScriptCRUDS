<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de comments</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de comments</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('post_id') }}</th>
                <td>{{ $item->post_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('user_id') }}</th>
                <td>{{ $item->user_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('comment') }}</th>
                <td>{{ $item->comment }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('comments.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
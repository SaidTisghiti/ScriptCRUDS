<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de posts</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de posts</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('user_id') }}</th>
                <td>{{ $item->user_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('title') }}</th>
                <td>{{ $item->title }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('content') }}</th>
                <td>{{ $item->content }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
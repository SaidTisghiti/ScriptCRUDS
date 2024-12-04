<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de comments</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Listado de comments</h1>
    <a href="{{ route('comments.create') }}" class="btn btn-primary mb-3">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Post_id</th>
                <th>User_id</th>
                <th>Comment</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->post_id }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->comment }}</td>
                <td>
                    <a href="{{ route('comments.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('comments.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('comments.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
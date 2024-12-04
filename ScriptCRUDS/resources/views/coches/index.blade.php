<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de coches</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Listado de coches</h1>
    <a href="{{ route('coches.create') }}" class="btn btn-primary mb-3">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>O</th>
                <th>Precio</th>
                <th>Not</th>
                <th>Color</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->marca }}</td>
                <td>{{ $item->modelo }}</td>
                <td>{{ $item->o }}</td>
                <td>{{ $item->precio }}</td>
                <td>{{ $item->not }}</td>
                <td>{{ $item->color }}</td>
                <td>{{ $item->stock }}</td>
                <td>
                    <a href="{{ route('coches.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('coches.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('coches.destroy', $item->id) }}" method="POST" style="display:inline;">
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
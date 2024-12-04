<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de mantenimientos</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Listado de mantenimientos</h1>
    <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary mb-3">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Coche_id</th>
                <th>Empleado_id</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Costo</th>
                <th>Not</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->coche_id }}</td>
                <td>{{ $item->empleado_id }}</td>
                <td>{{ $item->descripcion }}</td>
                <td>{{ $item->fecha }}</td>
                <td>{{ $item->costo }}</td>
                <td>{{ $item->not }}</td>
                <td>
                    <a href="{{ route('mantenimientos.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('mantenimientos.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('mantenimientos.destroy', $item->id) }}" method="POST" style="display:inline;">
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
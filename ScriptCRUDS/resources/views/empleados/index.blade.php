<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de empleados</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Listado de empleados</h1>
    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Salario</th>
                <th>Not</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->puesto }}</td>
                <td>{{ $item->salario }}</td>
                <td>{{ $item->not }}</td>
                <td>
                    <a href="{{ route('empleados.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('empleados.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('empleados.destroy', $item->id) }}" method="POST" style="display:inline;">
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de ventas</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Listado de ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Coche_id</th>
                <th>Cliente_id</th>
                <th>Empleado_id</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Not</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->coche_id }}</td>
                <td>{{ $item->cliente_id }}</td>
                <td>{{ $item->empleado_id }}</td>
                <td>{{ $item->fecha }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->not }}</td>
                <td>
                    <a href="{{ route('ventas.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('ventas.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('ventas.destroy', $item->id) }}" method="POST" style="display:inline;">
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
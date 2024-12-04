<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar clientes</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar clientes</h1>
    <form action="{{ route('clientes.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="nombre" class="form-label">{{ ucfirst('nombre') }}</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $item->nombre }}" required>
        </div>        <div class="mb-3">
            <label for="email" class="form-label">{{ ucfirst('email') }}</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $item->email }}" required>
        </div>        <div class="mb-3">
            <label for="telefono" class="form-label">{{ ucfirst('telefono') }}</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $item->telefono }}" required>
        </div>        <div class="mb-3">
            <label for="direccion" class="form-label">{{ ucfirst('direccion') }}</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $item->direccion }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
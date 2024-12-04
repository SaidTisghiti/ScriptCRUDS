<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear clientes</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear clientes</h1>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="nombre" class="form-label">{{ ucfirst('nombre') }}</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>        <div class="mb-3">
            <label for="email" class="form-label">{{ ucfirst('email') }}</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>        <div class="mb-3">
            <label for="telefono" class="form-label">{{ ucfirst('telefono') }}</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>        <div class="mb-3">
            <label for="direccion" class="form-label">{{ ucfirst('direccion') }}</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
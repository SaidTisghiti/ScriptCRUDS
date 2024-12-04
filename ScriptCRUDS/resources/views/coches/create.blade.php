<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear coches</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear coches</h1>
    <form action="{{ route('coches.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="marca" class="form-label">{{ ucfirst('marca') }}</label>
            <input type="text" class="form-control" id="marca" name="marca" required>
        </div>        <div class="mb-3">
            <label for="modelo" class="form-label">{{ ucfirst('modelo') }}</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required>
        </div>        <div class="mb-3">
            <label for="o" class="form-label">{{ ucfirst('o') }}</label>
            <input type="text" class="form-control" id="o" name="o" required>
        </div>        <div class="mb-3">
            <label for="precio" class="form-label">{{ ucfirst('precio') }}</label>
            <input type="text" class="form-control" id="precio" name="precio" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" required>
        </div>        <div class="mb-3">
            <label for="color" class="form-label">{{ ucfirst('color') }}</label>
            <input type="text" class="form-control" id="color" name="color" required>
        </div>        <div class="mb-3">
            <label for="stock" class="form-label">{{ ucfirst('stock') }}</label>
            <input type="text" class="form-control" id="stock" name="stock" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
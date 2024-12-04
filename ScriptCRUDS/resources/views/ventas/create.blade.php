<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear ventas</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear ventas</h1>
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="coche_id" class="form-label">{{ ucfirst('coche_id') }}</label>
            <input type="text" class="form-control" id="coche_id" name="coche_id" required>
        </div>        <div class="mb-3">
            <label for="cliente_id" class="form-label">{{ ucfirst('cliente_id') }}</label>
            <input type="text" class="form-control" id="cliente_id" name="cliente_id" required>
        </div>        <div class="mb-3">
            <label for="empleado_id" class="form-label">{{ ucfirst('empleado_id') }}</label>
            <input type="text" class="form-control" id="empleado_id" name="empleado_id" required>
        </div>        <div class="mb-3">
            <label for="fecha" class="form-label">{{ ucfirst('fecha') }}</label>
            <input type="text" class="form-control" id="fecha" name="fecha" required>
        </div>        <div class="mb-3">
            <label for="cantidad" class="form-label">{{ ucfirst('cantidad') }}</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" required>
        </div>        <div class="mb-3">
            <label for="total" class="form-label">{{ ucfirst('total') }}</label>
            <input type="text" class="form-control" id="total" name="total" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
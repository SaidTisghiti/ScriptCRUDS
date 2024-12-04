<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar mantenimientos</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar mantenimientos</h1>
    <form action="{{ route('mantenimientos.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="coche_id" class="form-label">{{ ucfirst('coche_id') }}</label>
            <input type="text" class="form-control" id="coche_id" name="coche_id" value="{{ $item->coche_id }}" required>
        </div>        <div class="mb-3">
            <label for="empleado_id" class="form-label">{{ ucfirst('empleado_id') }}</label>
            <input type="text" class="form-control" id="empleado_id" name="empleado_id" value="{{ $item->empleado_id }}" required>
        </div>        <div class="mb-3">
            <label for="descripcion" class="form-label">{{ ucfirst('descripcion') }}</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $item->descripcion }}" required>
        </div>        <div class="mb-3">
            <label for="fecha" class="form-label">{{ ucfirst('fecha') }}</label>
            <input type="text" class="form-control" id="fecha" name="fecha" value="{{ $item->fecha }}" required>
        </div>        <div class="mb-3">
            <label for="costo" class="form-label">{{ ucfirst('costo') }}</label>
            <input type="text" class="form-control" id="costo" name="costo" value="{{ $item->costo }}" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" value="{{ $item->not }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
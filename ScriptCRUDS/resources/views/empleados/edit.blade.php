<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar empleados</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar empleados</h1>
    <form action="{{ route('empleados.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="nombre" class="form-label">{{ ucfirst('nombre') }}</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $item->nombre }}" required>
        </div>        <div class="mb-3">
            <label for="puesto" class="form-label">{{ ucfirst('puesto') }}</label>
            <input type="text" class="form-control" id="puesto" name="puesto" value="{{ $item->puesto }}" required>
        </div>        <div class="mb-3">
            <label for="salario" class="form-label">{{ ucfirst('salario') }}</label>
            <input type="text" class="form-control" id="salario" name="salario" value="{{ $item->salario }}" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" value="{{ $item->not }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
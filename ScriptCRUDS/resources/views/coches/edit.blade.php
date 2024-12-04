<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar coches</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar coches</h1>
    <form action="{{ route('coches.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="marca" class="form-label">{{ ucfirst('marca') }}</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ $item->marca }}" required>
        </div>        <div class="mb-3">
            <label for="modelo" class="form-label">{{ ucfirst('modelo') }}</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $item->modelo }}" required>
        </div>        <div class="mb-3">
            <label for="o" class="form-label">{{ ucfirst('o') }}</label>
            <input type="text" class="form-control" id="o" name="o" value="{{ $item->o }}" required>
        </div>        <div class="mb-3">
            <label for="precio" class="form-label">{{ ucfirst('precio') }}</label>
            <input type="text" class="form-control" id="precio" name="precio" value="{{ $item->precio }}" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" value="{{ $item->not }}" required>
        </div>        <div class="mb-3">
            <label for="color" class="form-label">{{ ucfirst('color') }}</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ $item->color }}" required>
        </div>        <div class="mb-3">
            <label for="stock" class="form-label">{{ ucfirst('stock') }}</label>
            <input type="text" class="form-control" id="stock" name="stock" value="{{ $item->stock }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
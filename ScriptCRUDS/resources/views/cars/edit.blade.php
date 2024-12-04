<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar cars</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar cars</h1>
    <form action="{{ route('cars.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="brand" class="form-label">{{ ucfirst('brand') }}</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ $item->brand }}" required>
        </div>        <div class="mb-3">
            <label for="model" class="form-label">{{ ucfirst('model') }}</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ $item->model }}" required>
        </div>        <div class="mb-3">
            <label for="year" class="form-label">{{ ucfirst('year') }}</label>
            <input type="text" class="form-control" id="year" name="year" value="{{ $item->year }}" required>
        </div>        <div class="mb-3">
            <label for="price" class="form-label">{{ ucfirst('price') }}</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $item->price }}" required>
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
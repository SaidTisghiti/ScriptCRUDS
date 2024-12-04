<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear cars</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear cars</h1>
    <form action="{{ route('cars.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="brand" class="form-label">{{ ucfirst('brand') }}</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>        <div class="mb-3">
            <label for="model" class="form-label">{{ ucfirst('model') }}</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>        <div class="mb-3">
            <label for="year" class="form-label">{{ ucfirst('year') }}</label>
            <input type="text" class="form-control" id="year" name="year" required>
        </div>        <div class="mb-3">
            <label for="price" class="form-label">{{ ucfirst('price') }}</label>
            <input type="text" class="form-control" id="price" name="price" required>
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
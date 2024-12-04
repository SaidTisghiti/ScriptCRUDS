<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear employees</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear employees</h1>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="name" class="form-label">{{ ucfirst('name') }}</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>        <div class="mb-3">
            <label for="position" class="form-label">{{ ucfirst('position') }}</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>        <div class="mb-3">
            <label for="salary" class="form-label">{{ ucfirst('salary') }}</label>
            <input type="text" class="form-control" id="salary" name="salary" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
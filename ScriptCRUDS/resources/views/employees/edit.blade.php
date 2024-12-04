<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar employees</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar employees</h1>
    <form action="{{ route('employees.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="name" class="form-label">{{ ucfirst('name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
        </div>        <div class="mb-3">
            <label for="position" class="form-label">{{ ucfirst('position') }}</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ $item->position }}" required>
        </div>        <div class="mb-3">
            <label for="salary" class="form-label">{{ ucfirst('salary') }}</label>
            <input type="text" class="form-control" id="salary" name="salary" value="{{ $item->salary }}" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" value="{{ $item->not }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
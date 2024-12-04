<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar maintenance</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar maintenance</h1>
    <form action="{{ route('maintenance.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="car_id" class="form-label">{{ ucfirst('car_id') }}</label>
            <input type="text" class="form-control" id="car_id" name="car_id" value="{{ $item->car_id }}" required>
        </div>        <div class="mb-3">
            <label for="employee_id" class="form-label">{{ ucfirst('employee_id') }}</label>
            <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $item->employee_id }}" required>
        </div>        <div class="mb-3">
            <label for="description" class="form-label">{{ ucfirst('description') }}</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $item->description }}" required>
        </div>        <div class="mb-3">
            <label for="date" class="form-label">{{ ucfirst('date') }}</label>
            <input type="text" class="form-control" id="date" name="date" value="{{ $item->date }}" required>
        </div>        <div class="mb-3">
            <label for="cost" class="form-label">{{ ucfirst('cost') }}</label>
            <input type="text" class="form-control" id="cost" name="cost" value="{{ $item->cost }}" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" value="{{ $item->not }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>